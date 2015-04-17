<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Auth;
use DB;
use Request;
use Hash;
use View;
use Session;

class UserController extends Controller {

	public function showProfile(){
		$user_id = Auth::user()->id;

		$query = "SELECT * FROM USER WHERE id = '$user_id' ";
		$result = DB::select(DB::raw($query));

		//retrieve major name
		$major_id = Auth::user()->user_major;
		$query2 = "SELECT * FROM MAJOR WHERE major_id = '$major_id'";
		$major_result = DB::select(DB::raw($query2));

		//fetch student/teacher/alumnus info
		if(Auth::user()->type == 1){ //student
			$query3 = "SELECT * FROM STUDENT WHERE stu_id = '$user_id'";
			$indiv_result = DB::select(DB::raw($query3));
		}
		else if(Auth::user()->type == 2){ //teacher
			$query3 = "SELECT * FROM TEACHER WHERE teacher_id = '$user_id'";
			$indiv_result = DB::select(DB::raw($query3));
		}
		else if(Auth::user()->type == 3){ //alumnus
			$query3 = "SELECT DISTINCT OCCUPATION.occ_name FROM OCCUPATION INNER JOIN ALUMNUS_OCC ON OCCUPATION.occ_id = ALUMNUS_OCC.alum_occ_id INNER JOIN USER ON ALUMNUS_OCC.alum_id = '$user_id'";
			$indiv_result = DB::select(DB::raw($query3));
		}

		return View::make('pages.user.profile')->with('result', $result)->with('major', $major_result)->with('indiv', $indiv_result);
	}

	public function addUserByType($user_type){
		if($user_type == "student") return View::make('pages.admin.adminAdd')->with('user_type', 'student');
		else if($user_type == "teacher") return View::make('pages.admin.adminAdd')->with('user_type', 'teacher');
		else if($user_type == "alumnus") return View::make('pages.admin.adminAdd')->with('user_type', 'alumnus');
		else if($user_type == "admin") return View::make('pages.admin.adminAdd')->with('user_type', 'admin');
	}

	public function addUser($pre_cond){
		//check if user id isn't already in 
		$id = Request::input('user_id');
		$check_query = "SELECT id FROM USER WHERE id = '$id' LIMIT 1";
		$check_result = DB::select(DB::raw($check_query));
		$valid_user = 1 - sizeof($check_result);

		if($valid_user == 1 && $pre_cond == 1){ 
			$fname = Request::input('fname');
			$lname = Request::input('lname');
			$address = Request::input('address');
			$major = Request::input('major');
			$password = Request::input('password');
			$hashPassword = Hash::make($password);

			$query = "INSERT INTO USER (id, first_name, last_name, address, user_major, type, password) 
			VALUES ('$id', '$fname', '$lname', '$address', '$major', 1, '$hashPassword') ";
			DB::statement($query);
		}
		else{
			Session::flash('error-message', 'Id '.$id.' already exists in the database!');
		}
		return $valid_user;
	}

	public function addStudent(){
		$id = Request::input('user_id');
		$gpax = Request::input('gpax');
		$advisor_id = Request::input('advisor_id');
		
		$check_query = "SELECT teacher_id FROM TEACHER WHERE teacher_id = '$advisor_id' LIMIT 1";
		$check_result = DB::select(DB::raw($check_query));
		$valid_advisor = sizeof($check_result);
		$valid_user = $this->addUser($valid_advisor);

		if($valid_user == 1 && $valid_advisor == 1){
			$query = "INSERT INTO STUDENT (stu_id, gpax, advisor_id) VALUES ('$id', $gpax, '$advisor_id')";
			DB::statement($query);
		}
		else if($valid_advisor == 0){
			Session::flash('error-message', 'Advisor '. $advisor_id .' is not in the database!');
		}
		echo $advisor_id;
		return redirect('addUser');
	}

	public function editProfile(){
		$user = Auth::input('user_id');
		$user_id = $user['id'];

		$query = "SELECT * FROM USER WHERE id = '$user_id'";
		$result = DB::select(DB::raw($query));
	}


}
