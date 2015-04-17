<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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

}
