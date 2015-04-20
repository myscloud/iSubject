<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use DB;
use Session;
use Auth;
use View;
use Request;

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
		$startStr = date("Y-m-d h:i:s", $startDateTime->getTimestamp());
		
		if($endDate !== "" && $endTime !== ""){
			$endDateTime = date_create_from_format("Y-m-d-H:i", $endDate.'-'.$endTime);
			$endStr = date("Y-m-d h:i:s", $endDateTime->getTimestamp());
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

	public function showEvent(){
		return View::make('pages.user.eventDetail');
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

	public function showCalendar(){
		return View::make('pages.user.calendar');
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
