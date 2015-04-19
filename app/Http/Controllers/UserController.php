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
		else if($user_type == "admin") return View::make('pages.admin.adminAdd')->with('user_type', 'admin');
	}

	public function addUser($type){
		$id = Request::input('user_id');
		$fname = Request::input('fname');
		$lname = Request::input('lname');
		$password = Request::input('password');
		$hashPassword = Hash::make($password);
		$query = "INSERT INTO USER (id, first_name, last_name, type, password) VALUES ('$id', '$fname', '$lname', $type, '$hashPassword')";

		if($type < 3){
			$address = Request::input('address');
			$major = Request::input('major');
			$query = "INSERT INTO USER (id, first_name, last_name, address, user_major, type, password) 
		VALUES ('$id', '$fname', '$lname', '$address', '$major', $type, '$hashPassword') ";
		}

		DB::statement($query);
	}

	public function addStudent(){
		$id = Request::input('user_id');
		$major_id = Request::input('major');
		$gpax = Request::input('gpax');
		$advisor_id = Request::input('advisor_id');
		
		$exist_user = $this->existUser($id);
		$valid_advisor = $this->existTeacher($advisor_id);
		$exist_major = $this->existMajor($major_id);

		if($exist_user == 0 && $valid_advisor == 1 && $exist_major == 1){
			$this->addUser(1);
			$query = "INSERT INTO STUDENT (stu_id, gpax, advisor_id) VALUES ('$id', $gpax, '$advisor_id')";
			DB::statement($query);
		}
		else if($exist_user == 1){
			Session::flash('error-message', 'User '. $id .' already exists in the database!');
		}
		else if($valid_advisor == 0){
			Session::flash('error-message', 'Advisor '. $advisor_id .' is not in the database!');
		}
		else if($exist_major == 0){
			Session::flash('error-message', 'Major '. $major_id .' is not in the database!');
		}
		return redirect('addUser');
	}

	public function addTeacher(){
		$id = Request::input('user_id');
		$room = Request::input('room');
		$position = Request::input('position');
		$specialize = Request::input('specialize');
		$major_id = Request::input('major');

		$exist_user = $this->existUser($id);
		$exist_major = $this->existMajor($major_id);

		if($exist_user == 0 && $exist_major == 1){
			$this->addUser(2);
			$query = "INSERT INTO TEACHER(teacher_id, tea_room, position, specialize) VALUES ('$id', '$room', '$position', '$specialize')";
			DB::statement($query);
		}
		else if($exist_user == 1){
			Session::flash('error-message', 'User '. $id .' already exists in the database!');
		}
		else if($exist_major == 0){
			Session::flash('error-message', 'Major '. $major_id .' is not in the database!');
		}
		return redirect('addUser/teacher');
	}

	public function addAdmin(){
		$id = Request::input('user_id');
		$exist_user = $this->existUser($id);
		if($exist_user == 0){
			$this->addUser(4);
		}
		else{
			Session::flash('error-message', 'User '. $id .' already exists in the database!');
		}
		return redirect('addUser/admin');
	}

	/*public function editProfile(){
		$user = Auth::input('user_id');
		$user_id = $user['id'];
		$exist_user = $this->existUser($user_id);

		if($exist_user == 1){
			$query = "SELECT * FROM USER WHERE id = '$user_id'";
			$result = DB::select(DB::raw($query));
		}
		else{
			Session::flash('error-message', 'User '. $id .' already exists in the database!');
		}
	}*/

	public function updateUserStatus(){
		$user_id = Request::input('user_id');
		$exist_user = $this->existUser($user_id);
		if($exist_user == 1){
			$query = "UPDATE USER SET type=3 WHERE id = '$user_id'";
			DB::statement($query);
		}
		else{
			Session::flash('error-message', 'User '. $user_id .' is not in the database!');
		}
		return redirect('updateStatus');
	}

	public function showChangePassword(){
		return View::make('pages.user.password');
	}

	public function changePassword(){
		$old_pass = Request::input('old_pass');
		$new_pass = Request::input('new_pass');
		$renew_pass = Request::input('renew_pass');
		$user_id = Auth::user()->id;

		//retrieve old password from database
		$query = "SELECT password FROM USER WHERE id = '$user_id'";
		$result = DB::select(DB::raw($query));
		$real_old_pass = $result[0]->password;

		if(Hash::check($old_pass, $real_old_pass)){
			if($new_pass == $renew_pass){
				$hashPassword = Hash::make($new_pass);
				$query2 = "UPDATE USER SET password='$hashPassword' WHERE id='$user_id'";
				DB::statement($query2);
			}
			else Session::flash('error-message', 'New password and re-new password are mismatch!');
		}
		else Session::flash('error-message', 'Wrong old password!');
		return redirect('profile');
	}

	//---------------------------INTERNAL FUNCTION---------------------------
	public function existUser($user_id){
		$check_query = "SELECT id FROM USER WHERE id = '$user_id' LIMIT 1";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}

	public function existTeacher($user_id){
		$check_query = "SELECT teacher_id FROM TEACHER WHERE teacher_id = '$user_id' LIMIT 1";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}

	public function existMajor($major_id){
		$check_query = "SELECT major_id FROM MAJOR WHERE major_id = '$major_id'";
		$check_result = DB::select(DB::raw($check_query));
		return sizeof($check_result);
	}
}
