<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Session;
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
		$stu_id = Request::input('stu_id');
		$year = Request::input('aca_year');
		$semester = Request::input('semester');

		$exist_student = $this->existStudent($stu_id);
		$exist_section = $this->existSection($c_id, $section, $year, $semester);
		$exist_registration = $this->existRegistration($stu_id, $c_id, $section, $year, $semester);

		if($exist_student == 1 && $exist_section == 1 && $exist_registration == 0){
			$query = "INSERT INTO REGISTRATION (reg_course,reg_sec,reg_year,reg_semester,reg_student) VALUES ('$c_id','$section','$year','$semester','$stu_id')";
			DB::statement($query);
		}
		else if($exist_student == 0) Session::flash('error-message', 'User '. $stu_id .' is not a student!');
		else if($exist_section == 0) Session::flash('error-message', 'Section is not in the database!');
		else if($exist_registration == 1) Session::flash('error-message', 'The registration already exists in the database!');
		return redirect('addStudent');
	}

	/*public function addTeacherToCourse(){
		$t_course = Request::input('course_id');
		$t_sec = Request::input('section');
		$t_year = 2014;
		$t_sem = 2;
		$t_id = Request::input('teacher_id');
		
		$query = "INSERT INTO TEACHING (teach_course,teach_sec,teach_year,teach_semester,teach_teacher_id)
		VALUES ('$t_course','$t_sec','$t_year','$t_sem','$t_id')";

		DB::statement($query);	
	}*/

	public function editStudentInCourse(){
		$c_id = Request::input('c_id');
		$sec = Request::input('sec');
		$stu_id = Request::input('stu_id');
		$aca_year = Request::input('year');
		$semester = Request::input('semester');

		$exist_student = $this->existStudent($stu_id);
		$exist_section = $this->existSection($c_id, $sec, $aca_year, $semester);

		if($exist_student == 1 && $exist_section == 1){
			$query = "DELETE FROM REGISTRATION where reg_course = $c_id AND reg_sec = $sec AND reg_student = '$stu_id'";
			DB::statement($query);	
		}
		else if($exist_student == 0) Session::flash('error-message', 'User '. $stu_id .' is not a student!');
		else if($exist_section == 0) Session::flash('error-message', 'Section is not in the database!');

		return redirect('updateSection');
	}



	//-------------------------validation function-------------------------
	public function existStudent($user_id){
		$check_query = "SELECT stu_id FROM STUDENT WHERE stu_id = '$user_id' LIMIT 1";
		$exist_student = DB::select(DB::raw($check_query));
		return sizeof($exist_student);
	}

	public function existSection($course, $secnum, $year, $semester){
		$check_query = "SELECT * FROM SECTION WHERE course_id_sec = '$course' AND sec_num = '$secnum' AND aca_year = '$year' AND semester = '$semester' LIMIT 1";
		$exist_section = DB::select(DB::raw($check_query));
		return sizeof($exist_section);
	}

	public function existRegistration($stu_id, $course_id, $section, $year, $semester){
		$check_query = "SELECT * FROM REGISTRATION WHERE reg_course = '$course_id' AND reg_sec = '$section' AND reg_year = '$year' AND reg_semester = '$semester' AND reg_student = '$stu_id' LIMIT 1";
		$exist_registration = DB::select(DB::raw($check_query));
		return sizeof($exist_registration);
	}

}
