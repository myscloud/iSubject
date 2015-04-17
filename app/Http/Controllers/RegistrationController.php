<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use DB;
use Auth;

class RegistrationController extends Controller {

	public function showStudyingCourse(){
		$n_term = 2014;
		$query = "SELECT * FROM REGISTRATION where reg_year = '$n_term'";
		$result = DB::select(DB::raw($query));
		return $result;
	}

	public function showAllStudiedCourse(){
		$s_id = 5530042121;
		$query = "SELECT * FROM REGISTRATION";
		$result = DB::select(DB::raw($query));
		return $result;
	}

	public function showTeachingCourse(){
		$n_teach = 2014;
		$query = "SELECT * FROM TEACHING where teach_year = '$n_teach'";
		$result = DB::select(DB::raw($query));
		return $result;
	}

	public function showAllTaughtCourse(){
		$t_id = 2;
		$query = "SELECT * FROM TEACHING where teach_teacher_id = '$t_id'";
		$result = DB::select(DB::raw($query));
		return $result;
	}

	public function addStudentToCourse(){
		$c_id = Request::input('course_id');
		$section = Request::input('section');
		$std_id = Request::input('std_id');
		$year = 2014;
		$semester = 2;

		$query = "INSERT INTO REGISTRATION (reg_course,reg_sec,reg_year,reg_semester,reg_student)
		VALUES ('$c_id','$section','$year','$semester','$std_id')";

		DB::statement($query);
	}

	public function addTeacherToCourse(){
		$t_course = Request::input('course_id');
		$t_sec = Request::input('section');
		$t_year = 2014;
		$t_sem = 2;
		$t_id = Request::input('teacher_id');
		
		$query = "INSERT INTO TEACHING (teach_course,teach_sec,teach_year,teach_semester,teach_teacher_id)
		VALUES ('$t_course','$t_sec','$t_year','$t_sem','$t_id')";

		DB::statement($query);	
	}

	public function editStudentInCourse(){
		$c_id = Request::input('c_id');
		$sec = Request::input('sec');
		$std_id = Request::input('std_id');

		$query = "DELETE FROM REGISTRATION where reg_course = $c_id AND reg_sec = $sec AND reg_student = '$std_id'";

		DB::statement($query);	
	}












}
