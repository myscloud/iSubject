<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use DB;
use Session;
use Auth;
use View;
use Request;
use Redirect;

class EventController extends Controller {

	public function addEvent(){
		$event_name = Request::input('event_name');
		$event_des = Request::input('event_des');
		$startTime = Request::input('startTime');
		$endTime = Request::input('endTime');
		$startDate = Request::input('startDate');
		$endDate = Request::input('endDate');

		if(Request::input('homework')) $homework = 1;
		else $homework = 0;

		$startDateTime = date_create_from_format("Y-m-d-H:i", $startDate.'-'.$startTime);
		$startStr = date("Y-m-d H:i:s", $startDateTime->getTimestamp());
		
		if($endDate !== "" && $endTime !== ""){
			$endDateTime = date_create_from_format("Y-m-d-H:i", $endDate.'-'.$endTime);
			$endStr = date("Y-m-d H:i:s", $endDateTime->getTimestamp());
		}
		else $endStr = $startStr;

		$query = "INSERT INTO EVENT (event_name, description, start_time, end_time, isHomework) VALUES ('$event_name', '$event_des', '$startStr', '$endStr', '$homework')";
		DB::statement($query);

		//get event id
		$get_query = "SELECT MAX(event_id) AS last_id FROM EVENT";
		$result = DB::select(DB::raw($get_query));
		$event_id = $result[0]->last_id;
		return $event_id;
	}

	public function showAddEvent($course_id, $section, $semester, $year){
		$user_id = Auth::user()->id;
		
		$query = "SELECT * FROM TEACHING WHERE teach_course = '$course_id' AND teach_sec = '$section' AND teach_semester = '$semester' AND teach_year = '$year' AND teach_teacher_id = '$user_id' LIMIT 1";
		$perm = sizeof(DB::select(DB::raw($query)));

		$course_query = "SELECT course_name FROM COURSE WHERE course_id = '$course_id'";
		$course_name = DB::select(DB::raw($course_query));
		return View::make('pages.user.addEvent')->with('course_id', $course_id)->with('section', $section)->with('semester', $semester)->with('year', $year)->with('perm', $perm)->with('course_name', $course_name);
	}

	public function addUserEvent(){
		$course_id = Request::input('course_id');
		$semester = Request::input('semester');
		$year = Request::input('year');
		$section = Request::input('section');
		$event_id = $this->addEvent();

		$query = "INSERT INTO SECTION_EVENT (event_course, event_sec, event_aca_year, event_semester, event_id) VALUES ('$course_id', '$section', '$year', '$semester', '$event_id')";
		DB::statement($query);
		return Redirect::action('CourseController@showSectionDetail', array('course_id'=>$course_id, 'sec'=>$section, 'sem'=>$semester, 'year'=>$year));
	}

	public function addEventAdmin(){
		$sec_option = Request::input('radioChoose');
		$choose_sec = Request::input('chooseSec');

		$course_id = Request::input('course_id');
		$semester = Request::input('semester');
		$aca_year = Request::input('year');
		
		if($sec_option == "all"){
			$valid = $this->existSomeSections($course_id, $aca_year, $semester);
			if($valid >= 1){
				$event_id = $this->addEvent();
				$query = "SELECT sec_num FROM SECTION WHERE course_id_sec = '$course_id' AND aca_year = '$aca_year' AND semester = '$semester'";
				$result = DB::select(DB::raw($query));
				foreach ($result as $key => $value) {
					$sec_num = $value->sec_num;
					$query2 = "INSERT INTO SECTION_EVENT (event_id, event_course, event_sec, event_aca_year, event_semester) VALUES ('$event_id', '$course_id', '$sec_num', '$aca_year', '$semester')";
					DB::statement($query2);
				}
			}
		}
		else if($sec_option == "some"){
			$valid = $this->existManySections($course_id, $choose_sec, $aca_year, $semester);
			if($valid == 1){
				$event_id = $this->addEvent();
				$section = strtok($choose_sec, ", ");
				while($section != false){
					$query = "INSERT INTO SECTION_EVENT (event_id, event_course, event_sec, event_aca_year, event_semester) VALUES ('$event_id', '$course_id', '$section', '$aca_year', '$semester')";
					DB::statement($query);
					$section = strtok(", ");
				}
			}
		}

		return redirect('addEvent');
	}

	public function showEventDetail($event_id){
		$course_query = "SELECT DISTINCT COURSE.course_name, event_course, event_semester, event_aca_year FROM SECTION_EVENT INNER JOIN COURSE ON SECTION_EVENT.event_course = COURSE.course_id AND event_id = '$event_id'";
		$course_result = DB::select(DB::raw($course_query));

		$section_query = "SELECT event_sec FROM SECTION_EVENT WHERE event_id = '$event_id'";
		$section_result = DB::select(DB::raw($section_query));

		$event_query = "SELECT * FROM EVENT WHERE event_id = '$event_id'";
		$event_result = DB::select(DB::raw($event_query));

		$edit_perm = $this->editEventPermission($event_id, Auth::user()->id);

		//check if same date
		$start_time = $event_result['0']->start_time;
		$end_time = $event_result['0']->end_time;
		if(date('Y-m-d', strtotime($start_time)) == date('Y-m-d', strtotime($end_time)) ) $same_date = 1;
		else $same_date = 0;

		return View::make('pages.user.eventDetail')->with('course_result', $course_result)->with('section_result', $section_result)->with('event_result', $event_result)->with('same_date', $same_date)->with('edit_perm', $edit_perm);
	}

	public function showCurrentCalendar(){
		$c_month = date('m');
		$c_year = date('Y');
		return $this->showCalendar($c_year, $c_month);
	}

	public function showCalendar($year, $month){
		$first_date = $year . '-' . $month . '-1 00:00:00';
		$last_date = date('Y-m-t 23:59:59', strtotime($first_date));

		$query = "SELECT EVENT.*, COURSE.course_name FROM EVENT INNER JOIN SECTION_EVENT ON SECTION_EVENT.event_id = EVENT.event_id INNER JOIN REGISTRATION ON SECTION_EVENT.event_course = REGISTRATION.reg_course AND SECTION_EVENT.event_sec = REGISTRATION.reg_sec AND SECTION_EVENT.event_semester = REGISTRATION.reg_semester AND SECTION_EVENT.event_aca_year = REGISTRATION.reg_year INNER JOIN USER ON REGISTRATION.reg_student = USER.id INNER JOIN COURSE ON SECTION_EVENT.event_course = COURSE.course_id WHERE EVENT.start_time BETWEEN '$first_date' AND '$last_date' OR EVENT.end_time BETWEEN '$first_date' AND '$last_date' ORDER BY EVENT.start_time ASC";
		$result = DB::select(DB::raw($query));

		$calendar = [];
		for ($i=1; $i <= 31 ; $i++) {
			$calendar[$i] = [];
			$calendar[$i]['date'] = $i;
			$calendar[$i]['day_of_week'] = Date('l', strtotime($year.'-'.$month.'-'.$i));
			$calendar[$i]['event'] = [];
		}

		foreach ($result as $key => $event) {
			//echo $event->event_id . '<br>';
			$start_date = strtotime($first_date);
			$end_date = strtotime($last_date);
			$event_start_date = strtotime($event->start_time);
			$event_end_date = strtotime($event->end_time);

			if($event_start_date > $start_date) $start_date = $event_start_date;
			if($event_end_date < $end_date) $end_date = $event_end_date;

			$d1 = Date('j', $start_date);
			$d2 = Date('j', $end_date);

			for ($i = $d1; $i <= $d2; $i++) { 
				$idx = sizeof($calendar[$i]['event']);
				$calendar[$i]['event'][$idx] = $event;		
			}
		}
		
		$next_month = strtotime(date('Y-m-d', strtotime($first_date))." +1 month");
		$prev_month = strtotime(date('Y-m-d', strtotime($first_date))." -1 month");
		return View::make('pages.user.calendar')->with('calendar', $calendar)->with('month', Date('F',strtotime($year.'-'.$month.'-1')))->with('year', $year)->with('prev_mo', Date('n', $prev_month))->with('prev_year', Date('Y',$prev_month))->with('next_mo',Date('n',$next_month))->with('next_year', Date('Y',$next_month));
	}

	public function showEditEvent($event_id){
		$query = "SELECT * FROM EVENT WHERE event_id = '$event_id'";
		$result = DB::select(DB::raw($query));
		$perm = $this->editEventPermission($event_id, Auth::user()->id);
		return View::make('pages.user.editEvent')->with('result', $result)->with('perm', $perm);
	}

	public function editEvent(){
		$event_id = Request::input('event_id');
		$event_name = Request::input('event_name');
		$event_des = Request::input('event_des');
		$startTime = Request::input('startTime');
		$endTime = Request::input('endTime');
		$startDate = Request::input('startDate');
		$endDate = Request::input('endDate');

		$startDateTime = date_create_from_format("Y-m-d-H:i", $startDate.'-'.$startTime);
		$startStr = date("Y-m-d H:i:s", $startDateTime->getTimestamp());
		
		if(isset($endDate) && isset($endTime)){
			$endDateTime = date_create_from_format("Y-m-d-H:i", $endDate.'-'.$endTime);
			$endStr = date("Y-m-d H:i:s", $endDateTime->getTimestamp());
		}
		else $endStr = $startStr;

		$query = "UPDATE EVENT SET event_name = '$event_name', description = '$event_des', start_time = '$startStr', end_time = '$endStr' WHERE event_id = '$event_id'";
		DB::statement($query);
		return redirect('eventDetail/'.$event_id);
	}

	public function deleteEvent(){
		$event_id = Request::input('event_id');
		$section_query = "DELETE FROM SECTION_EVENT WHERE event_id = '$event_id'";
		DB::statement($section_query);

		$event_query = "DELETE FROM EVENT WHERE event_id = '$event_id'";
		DB::statement($event_query);
		return redirect('/courseList');
	}

	//-------------------------internal function-------------------------

	public function editEventPermission($event_id, $user_id){
		$query = "SELECT SECTION_EVENT.* FROM SECTION_EVENT INNER JOIN TEACHING ON SECTION_EVENT.event_id = '$event_id' AND SECTION_EVENT.event_course = TEACHING.teach_course AND SECTION_EVENT.event_sec = TEACHING.teach_sec AND SECTION_EVENT.event_semester = TEACHING.teach_semester AND SECTION_EVENT.event_aca_year = TEACHING.teach_year AND TEACHING.teach_teacher_id = '$user_id' LIMIT 1";
		$result = DB::select(DB::raw($query));
		return sizeof($result);
	}

	//-------------------------validation function-------------------------
	
	public function existSomeSections($course, $year, $semester){
		$check_query = "SELECT * FROM SECTION WHERE course_id_sec = '$course' AND aca_year = '$year' AND semester = '$semester'";
		$result = DB::select(DB::raw($check_query));
		if(sizeof($result) == 0){
			Session::flash('error-message', 'There is no section in this course!');
		}
		return sizeof($result);
	}

	public function existManySections($course, $sec_str, $year, $semester){
		$section = strtok($sec_str, ", ");
		$exist_section = 0;
		while($section !== false){
			$exist_section = $this->existSection($course, $section, $year, $semester);
			if($exist_section == 0){
				Session::flash('error-message', 'Section '. $section .' is not in the database!');
				break;
			}
			$section = strtok(", ");
		}
		return $exist_section;
	}

	public function existSection($course, $secnum, $year, $semester){
		$check_query = "SELECT * FROM SECTION WHERE course_id_sec = '$course' AND sec_num = '$secnum' AND aca_year = '$year' AND semester = '$semester' LIMIT 1";
		$exist_section = DB::select(DB::raw($check_query));
		return sizeof($exist_section);
	}
}
