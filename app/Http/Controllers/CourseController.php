<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Request;
use DB;
use Auth;
use PDO;
use View;
use Session;

class CourseController extends Controller {

	public function showCourseDetail($course_id){
		$query = "SELECT * FROM COURSE WHERE course_id = '$course_id' ";
		$result = DB::select(DB::raw($query));
		$occupation_vote = $this->showOccupationVoteResult($course_id);
		$sections = $this->getSectionInCourse($course_id);

		return View::make('pages.user.courseDetail')->with('courseResult', $result)->with('sections', $sections)->with('occ_vote', $occupation_vote);	
	}

	public function getSectionInCourse($course_id){
		$c_month = date('m');
		$c_year = date('Y');
		$c_semester = 1;
		if($c_month < 7){
			$c_year = $c_year - 1;
			$c_semester = 2;
		}

		$query = "SELECT * FROM SECTION WHERE course_id_sec = '$course_id' AND aca_year = '$c_year' AND semester = '$c_semester'";
		return DB::select(DB::raw($query));
	}

	public function addCourse(){
		$id = Request::input('course_id');
		$name = Request::input('course_name');
		$major = Request::input('course_major');
		$des = Request::input('course_des');

		$exist_course = $this->existCourse($id);
		$exist_major = $this->existMajor($major);
		
		if($exist_course == 0 && $exist_major == 1){
			$query = "INSERT INTO COURSE (course_id, course_name, course_des, course_major)
			VALUES ('$id','$name','$des','$major')";
			DB::statement($query);
		}
		else if($exist_course == 1) Session::flash('error-message', 'Course '. $id .' already exists in the database!');
		else if($exist_major == 0) Session::flash('error-message', 'Major '. $major .' is not in the database!');

		return redirect('addCourse');
	}

	public function addSection(){
		$id = Request::input('course_id');
		$sec_num = Request::input('section');
		$aca_year = Request::input('year');
		$sem = Request::input('semester');
		$classroom = Request::input('room');
		$t_id = Request::input('teacher_id');

		$exist_course = $this->existCourse($id);
		$exist_section = $this->existSection($id, $sec_num, $aca_year, $sem);
		$valid_teacher = $this->validateTeachers($t_id);
		
		if($exist_course == 1 && $valid_teacher == 1 && $exist_section == 0){
			$query = "INSERT INTO SECTION (course_id_sec, sec_num, aca_year, semester, classroom) VALUES ('$id','$sec_num','$aca_year','$sem','$classroom')";
			DB::statement($query);
			$this->addTeacherToSection($t_id, $id, $sec_num, $aca_year, $sem);
		}
		else if($valid_teacher == 0) { /* do nothing, just for preventing duplicate alert message */}
		else if($exist_course == 0) Session::flash('error-message', 'Course '. $id .' is not in the database!');
		else if($exist_section == 1) Session::flash('error-message', 'Section already exists in the database!');
		
		return redirect('addSection');
	}

	public function addTeacherToSection($teachers, $c_id, $sec, $year, $semester){
		$teacher = strtok($teachers, ", ");
		while($teacher !== false){
			$query = "INSERT INTO TEACHING (teach_teacher_id, teach_course, teach_sec, teach_year, teach_semester) VALUES ('$teacher', '$c_id', '$sec', '$year', '$semester')";
			DB::statement($query);
			$teacher = strtok(", ");
		}
	}

	public function searchCourseById(){
		$course_id = Request::input('course_id');

		//-----------not sql injection---------------
		/*$query = "SELECT * FROM COURSE WHERE course_id = $course_id";
		$result = DB::select(DB::raw($query));*/

		//-----------prevent sql injection---------------
		$pdo = DB::connection()->getPdo();
		$pattern = $course_id.'%';
		$query = $pdo->prepare("SELECT * FROM COURSE WHERE course_id LIKE '$pattern'");
		$query->bindParam(':c_id', $course_id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');
		return View::make('pages.user.search')->with('result', $result);
	}

	public function searchCourseByName(){
		$course_name = Request::input('course_name');
		$pattern = '%'.$course_name.'%';
		$query = "SELECT * FROM COURSE WHERE course_name LIKE '$pattern'";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.search')->with('result', $result);
	}

	public function showCurrentCourseList(){
		$c_month = date('m');
		$c_year = date('Y');
		$c_semester = 1;
		if($c_month < 7){
			$c_year = $c_year - 1;
			$c_semester = 2;
		}
		
		$user_id = Auth::user()->id;
		$query = "SELECT DISTINCT COURSE.course_id, COURSE.course_name, COURSE.course_des FROM COURSE INNER JOIN REGISTRATION ON REGISTRATION.reg_course = COURSE.course_id AND REGISTRATION.reg_year = $c_year AND REGISTRATION.reg_semester = $c_semester AND REGISTRATION.reg_student = '$user_id'";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.courseList')->with('result', $result)->with('page_type', 'current');
	}

	public function showAllRegisteredCourse(){
		$user_id = Auth::user()->id;
		$query = "SELECT DISTINCT COURSE.course_id, COURSE.course_name, COURSE.course_des FROM COURSE INNER JOIN REGISTRATION ON REGISTRATION.reg_course = COURSE.course_id AND REGISTRATION.reg_student = '$user_id'";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.courseList')->with('result', $result)->with('page_type', 'all');
	}

	public function showFavCourse(){
		$user_id = Auth::user()->id;
		$query = "SELECT DISTINCT COURSE.course_id, COURSE.course_name, COURSE.course_des FROM COURSE INNER JOIN FAV_COURSE ON FAV_COURSE.fav_course_id = COURSE.course_id AND FAV_COURSE.student_id = '$user_id'";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.courseList')->with('result', $result)->with('page_type', 'fav');
	}

	public function showSectionDetail($course_id, $sec, $sem, $year){
		//retrieve course name
		$course_query = "SELECT COURSE.course_name FROM COURSE WHERE course_id = '$course_id'";
		$course_name = DB::select(DB::raw($course_query));
		
		$room = $this->getSectionRoom($course_id, $sec, $sem, $year);
		$teachers = $this->getTeacherInSection($course_id, $sec, $sem, $year);

		return View::make('pages.user.sectionDetail')->with('course_id', $course_id)->with('sec', $sec)->with('semester', $sem)->with('year', $year)->with('course_name', $course_name)->with('teachers', $teachers)->with('room', $room);
	}

	//-------------------------internal function-------------------------
	public function getSectionRoom($course_id, $sec, $sem, $year){
		$query = "SELECT classroom FROM SECTION WHERE course_id_sec = '$course_id' AND sec_num = '$sec' AND aca_year = '$year' AND semester = '$sem'";
		return DB::select(DB::raw($query));
	}

	public function getTeacherInSection($course_id, $sec, $sem, $year){
		$query = "SELECT DISTINCT USER.first_name, USER.last_name FROM USER INNER JOIN TEACHING ON USER.id = TEACHING.teach_teacher_id AND TEACHING.teach_course = '$course_id' AND TEACHING.teach_sec = '$sec' AND TEACHING.teach_year = '$year' AND TEACHING.teach_semester = '$sem'";
		return DB::select(DB::raw($query));
	}

	public function showOccupationVoteResult($course_id){
		$query = "SELECT occ_name, COUNT(voter_id) AS vote_count FROM OCCUPATION INNER JOIN OCCUPATION_VOTE ON occ_id = vote_occ_id AND vote_course_id = '$course_id' GROUP BY vote_occ_id ORDER BY vote_count DESC";
		$result = DB::select(DB::raw($query));
		return $result;
	}

	//-------------------------validation function-------------------------
	public function validateTeachers($teachers){
		$teacher = strtok($teachers, ", ");
		$exist_teacher = 0;
		while($teacher !== false){
			$exist_teacher = $this->existTeacher($teacher);
			if($exist_teacher == 0){
				Session::flash('error-message', 'Teacher '. $teacher .' is not in the database!');
				break;
			}
			$teacher = strtok(", ");
		}
		return $exist_teacher;
	}

	public function existMajor($major_id){
		$check_query = "SELECT major_id FROM MAJOR WHERE major_id = '$major_id'";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}

	public function existCourse($course_id){
		$check_query = "SELECT course_id FROM COURSE WHERE course_id = '$course_id'";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}

	public function existSection($course, $secnum, $year, $semester){
		$check_query = "SELECT * FROM SECTION WHERE course_id_sec = '$course' AND sec_num = '$secnum' AND aca_year = '$year' AND semester = '$semester' LIMIT 1";
		$exist_section = DB::select(DB::raw($check_query));
		return sizeof($exist_section);
	}

	public function existTeacher($user_id){
		$check_query = "SELECT teacher_id FROM TEACHER WHERE teacher_id = '$user_id' LIMIT 1";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}
}
