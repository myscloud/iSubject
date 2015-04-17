<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StudentController extends Controller {

	public function courseDetail(){
		//echo "hi";
		return view('pages.user.courseDetail');
	}
	public function search(){
		//echo "hi";
		return view('pages.user.search');
	}
	public function addComment(){
		//echo "hi";
		return view('pages.user.addComment');
	}
	public function viewComment(){
		//echo "hi";
		return view('pages.user.viewComment');
	}
	public function courseList(){
		//echo "hi";
		return view('pages.user.courseList');
	}
	public function viewAlumnusComment(){
		//echo "hi";
		return view('pages.user.viewAlumnusComment');
	}
	public function profile(){
		//echo "hi";
		return view('pages.user.profile');
	}
	public function sectionDetail(){
		return view('pages.user.sectionDetail');
	}
	public function addEvent(){
		return view('pages.user.addEvent');
	}
}
