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
	public function showOccupationVote($course_id){
		$user_id = Auth::user()->id;

		$course_query = "SELECT course_id, course_name FROM COURSE WHERE course_id = '$course_id'";
		$course = DB::select(DB::raw($course_query));

		$occ_query = "SELECT * FROM OCCUPATION";
		$occupation = DB::select(DB::raw($occ_query));

		foreach ($occupation as $key => $occ) {
			$vote_result_query = "SELECT * FROM OCCUPATION_VOTE WHERE voter_id = '$user_id' AND vote_course_id = '$course_id' AND vote_occ_id = '$occ->occ_id'";
			$vote_result = DB::select(DB::raw($vote_result_query));
			$occ->vote = sizeof($vote_result);
		}
		return View::make('pages.user.alumnusComment')->with('result', $occupation)->with('course', $course);
	}

	public function voteOccupation(){
		$user_id = Auth::user()->id;
		$course_id = Request::input('course_id');
		$occupation = Request::input('occ');

		//get number of occupation
		$query1 = "SELECT occ_id FROM OCCUPATION";
		$all_occ = DB::select(DB::raw($query1));
		$occ_size = sizeof($all_occ);
		
		//initiate check_occ array
		$check_occ_new = [];
		$check_occ_old = [];
		for ($i=0; $i <= $occ_size; $i++) { 
			$check_occ_new[$i] = $check_occ_old[$i] = 0;
		}
		//create check_occ array for last vote result
		if($occupation != null){
			foreach ($occupation as $key => $value) {
				$check_occ_new[$value] = 1;
			}
		}
		//create check_occ array for old vote result
		$query2 = "SELECT vote_occ_id FROM OCCUPATION_VOTE WHERE vote_course_id = '$course_id' AND voter_id = '$user_id'";
		$old_vote = DB::select(DB::raw($query2));
		if($old_vote != null){
			foreach ($old_vote as $key => $vote) {
				$check_occ_old[$vote->vote_occ_id] = 1;
			}
		}

		for($i=0; $i <= $occ_size; $i++){
			if($check_occ_old[$i] == 1 && $check_occ_new[$i] == 0){ //remove vote
				$query3 = "DELETE FROM OCCUPATION_VOTE WHERE vote_course_id = '$course_id' AND vote_occ_id = '$i' AND voter_id = '$user_id'";
				DB::statement($query3);
			}
			else if($check_occ_old[$i] == 0 && $check_occ_new[$i] == 1){ //new vote
				$query4 = "INSERT INTO OCCUPATION_VOTE (voter_id, vote_course_id, vote_occ_id) VALUES ('$user_id', '$course_id', '$i')";
				DB::statement($query4);
			}
		}

		return redirect('courseDetail/' . $course_id);
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
