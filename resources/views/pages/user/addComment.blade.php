@extends('master')
@section('menu')
<div class="list-group">
	<a href="{{ URL::to('profile') }}" class="list-group-item">Profile</a>
	<a href="{{ URL::to('search') }}" class="list-group-item">Search</a>
	@if(Auth::user()->type == 1 || Auth::user()->type == 2)	
		<a href="{{ URL::to('calendar') }}" class="list-group-item">Calendar</a>
	@endif
	<a href="{{ URL::to('courseList') }}" class="list-group-item">Courselist</a>
	
</div>
@stop
@section('content')
<div class="panel-heading">
	<h3 class="panel-title">Comment</h3>
</div>
<div class="panel-body">
	<div>
		<div class="row">
			<div class="col-md-6">วิชา : XXXXXXXXXXXX</div>
			<div class="col-md-6">Section : XXXXXXXXXXXX</div>			
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class ="addComment-semester-feild">
					Semester : <input type="text" class="form-control" placeholder="Course id" aria-describedby="basic-addon2" name ="course_id">
				</div>
			</div>
			<div class="col-md-6">
				<div class ="addComment-year-feild">
					Academic Year : <input type="text" class="form-control" placeholder="Course id" aria-describedby="basic-addon2" name ="course_id">
				</div>
			</div>			
		</div>
		<br>
		<div class="row">
			<div class = "comment-in">
				<div class="col-md-5">
					Comment : <input type="text" class="form-control" placeholder="Add your comment" aria-describedby="basic-addon1">
				</div>
			</div>
			<div class="col-md-7">
			<br>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>			
		</div>
		
	</div>				
</div>

@stop