<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	public function login()
	{
		return view('pages.login');
	}
	public function admin()
	{
		return view('pages.admin.admin');
	}
	public function adminAdd()
	{
		return view('pages.admin.adminAdd')->with('user_type', 'student');
	}
	public function updateStatus()
	{
		return view('pages.admin.updateStatus');
	}
	public function addStudent()
	{
		return view('pages.admin.addStudent');
	}
	public function addCourse()
	{
		return view('pages.admin.addCourse');
	}
	public function addSection()
	{
		return view('pages.admin.addSection');
	}
	public function updateSection()
	{
		return view('pages.admin.updateSection');
	}
	public function profile()
	{
		return view('pages.admin.profile');
	}
	public function addEvent()
	{
		return view('pages.admin.addEvent');
	}

}
