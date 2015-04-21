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

	public function StudentComment($course_id){
		$user_id = Auth::user()->id;
		$registration = $this->getPassedRegistration($course_id, $user_id);
		$course_name = $this->getCourseName($course_id);

		return View::make('pages.user.addComment')->with('regis', $registration)->with('course_name', $course_name);
	}

	public function addStudentComment(){
		$course_id = Request::input('course_id');
		$section = Request::input('section');
		$semester = Request::input('semester');
		$year = Request::input('aca_year');
		$user_id = Auth::user()->id;
		$review = Request::input('review');

		$pdo = DB::connection()->getPdo();
		$query = $pdo->prepare("INSERT INTO STUDENT_REVIEW (rev_course, rev_sec, rev_sec_year, rev_sec_sem, rev_student, review_content, rev_time) VALUES ('$course_id', '$section', '$year', '$semester', '$user_id', :rv, now())");
		$query->bindParam(':rv', $review);
		$query->execute();


	}

	public function getPassedRegistration($course_id, $user_id){
		$c_month = date('m');
		$c_year = date('Y');
		$c_semester = 1;
		if($c_month < 7){
			$c_year = $c_year - 1;
			$c_semester = 2;
		}

		$query = "SELECT * FROM REGISTRATION WHERE reg_course = '$course_id' AND reg_student = '$user_id' AND (reg_year != '$c_year' OR reg_semester != '$c_semester') LIMIT 1";
		return DB::select(DB::raw($query));
	}

	public function getCourseName($course_id){
		$query = "SELECT course_name FROM COURSE WHERE course_id = '$course_id'";
		return DB::select(DB::raw($query));
	}

	public function searchComment($course_id){
		$section = Request::input('section');
		$year = Request::input('year');
		$semester = Request::input('semester');

		if($section == '') $section = 'NULL';
		if($year == '') $year = 'NULL';
		if($semester == '') $semester = 'NULL';

		$query = "SELECT DISTINCT USER.first_name, USER.last_name, STUDENT_REVIEW.review_content, STUDENT_REVIEW.rev_time FROM STUDENT_REVIEW INNER JOIN USER WHERE rev_student = USER.id AND rev_sec = IFNULL($section, rev_sec) AND rev_sec_year = IFNULL($year, rev_sec_year) AND rev_sec_sem = IFNULL($semester, rev_sec_sem) ORDER BY rev_time DESC";
		$result = DB::select(DB::raw($query));

		//just for using course name
		$course_query = "SELECT course_id, course_name FROM COURSE WHERE course_id = '$course_id'";
		$course = DB::select(DB::raw($course_query));
		return View::make('pages.user.viewComment')->with('comment', $result)->with('course', $course)->with('section', $section)->with('year', $year)->with('semester', $semester);
	}

	public function showComment($course_id){
		$query = "SELECT course_id, course_name FROM COURSE WHERE course_id = '$course_id'";
		$result = DB::select(DB::raw($query));

		$query_comment = "SELECT DISTINCT USER.first_name, USER.last_name, STUDENT_REVIEW.review_content, STUDENT_REVIEW.rev_time FROM STUDENT_REVIEW INNER JOIN USER WHERE rev_student = USER.id ORDER BY rev_time DESC";
		$comment = DB::select(DB::raw($query_comment));
		return View::make('pages.user.viewComment')->with('course', $result)->with('comment', $comment);
	}
}
