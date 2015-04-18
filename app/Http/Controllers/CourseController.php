<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use DB;
use Auth;
use PDO;
use View;

class CourseController extends Controller {

	public function showSection(){

		$s_id = 2;
		$query = "SELECT * FROM SECTION WHERE course_id_sec = '$s_id' ";
		$result = DB::select(DB::raw($query));
		return $result;	
	}

	public function showCourseDetail($course_id){
		$query = "SELECT * FROM COURSE WHERE course_id = '$course_id' ";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.courseDetail')->with('result', $result);	
	}

	public function addCourse(){
		$id = Request::input('course_id');
		$name = Request::input('course_name');
		$major = Request::input('course_major');
		$des = Request::input('course_des');

		$query = "INSERT INTO COURSE (course_id, course_name, course_des, course_major)
		VALUES ('$id','$name','$des','$major')";

		DB::statement($query);
	}

	public function addSection(){
		$id = Request::input('course_id');
		$sec_num = Request::input('section');
		$aca_year = Request::input('year');
		$sem = Request::input('semester');
		$classroom = Request::input('room');
		$t_id = Request::input('teacher_id');

		$query = "INSERT INTO SECTION (course_id_sec, sec_num, aca_year, semester, classroom)
		VALUES ('$id','$sec_num','$aca_year','$sem','$classroom')";

		DB::statement($query);
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

	public function showCourseList(){

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
		return View::make('pages.user.courseList')->with('result', $result);
	}
}
