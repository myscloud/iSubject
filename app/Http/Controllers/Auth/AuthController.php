<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Session;
use Request;
use Auth;

class AuthController extends Controller {

	public function authenticate(){
		$user_id = Request::input('user_id');
		$password = Request::input('password');
		$utype = Request::input('user_type');

		if(Auth::attempt(['id' => $user_id, 'password' => $password, 'type' => $utype])){
			if($utype == 4){ //admin
				return redirect('admin');
			}
			else{
				return redirect('courseList');
			}
		}
		else{
			Session::flash('error-message', 'Wrong Username/Password or User type');
			return redirect()->back();
		}
	}

}
