<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Request;
use DB;
use Auth;
use View;
use Session;
use PDO;
use Redirect;

class CommentController extends Controller {

	public function showStudentComment(){

		$r_id = 1;
		$query = "SELECT * FROM STUDENT_REVIEW WHERE review_id = '$r_id' ";
		$result = DB::select(DB::raw($query));
		return $result;	
	}

	public function showAlumnusComment(){

		$al_id = 8;
		$query = "SELECT * FROM ALUMNUS_REVIEW WHERE alum_rev_id = '$al_id' ";
		$result = DB::select(DB::raw($query));
		return $result;	
	}
	public function showOccupationVote(){

		$ov_id = 7;
		$query = "SELECT * FROM OCCUPATION_VOTE WHERE vote_occ_id = '$ov_id' ";
		$result = DB::select(DB::raw($query));
		return $result;	
	}

	public function alumnusComment($course_id){
		$query = "SELECT course_id, course_name FROM COURSE WHERE course_id = '$course_id'";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.addCommentAlumnus')->with('result', $result);
	}

	public function addAlumnusComment(){
		$user_id = Auth::user()->id;
		$course_id = Request::input('course_id');
		$comment = Request::input('comment');
		//$escape_comment = mysqli_real_escape_string(DB::connection(), $comment);
		/*
		$injected_query = "INSERT INTO ALUMNUS_REVIEW (alum_rev_course, rev_alum, alum_rev_content) VALUES ('$course_id', '$user_id', '$comment')";
		DB::statement($injected_query);
		*/
		
		$pdo = DB::connection()->getPdo();
		$query = $pdo->prepare("INSERT INTO ALUMNUS_REVIEW (alum_rev_course, rev_alum, alum_rev_time, alum_rev_content) VALUES ('$course_id', '$user_id', now(), :cm)");
		$query->bindParam(':cm', $comment);
		$query->execute();
		
		return redirect('courseDetail/' . $course_id);
	}

	public function getAlumnusComment($course_id){
		$query = "SELECT DISTINCT ALUMNUS_REVIEW.alum_rev_content, ALUMNUS_REVIEW.alum_rev_time, USER.first_name, USER.last_name FROM ALUMNUS_REVIEW INNER JOIN USER ON ALUMNUS_REVIEW.rev_alum = USER.id AND ALUMNUS_REVIEW.alum_rev_course = '$course_id' ORDER BY ALUMNUS_REVIEW.alum_rev_time DESC";
		$result = DB::select(DB::raw($query));
		return View::make('pages.user.viewAlumnusComment')->with('result', $result);
	}

}
