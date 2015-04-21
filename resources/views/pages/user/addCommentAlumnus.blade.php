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

@foreach($result as $course)
<div class="panel-body">
	<div>
		<div class="row">
			<div class="col-md-6">วิชา : {{ $course->course_name }}</div>		
		</div>
		<br>

		<form method="post" action="/addAlumnusComment">
			<input name="_token" hidden value="{!! csrf_token() !!}" />
			<input name="course_id" type="hidden" value="{{$course->course_id}}">
			
			<div class="row">
				<div class = "comment-in">
					<div class="col-md-5">
						Comment : <textarea class="form-control" placeholder="Add your comment" aria-describedby="basic-addon1" name="comment" rows="5"></textarea>
					</div>
				</div>
				<div class="col-md-7">
				<br>
					<input type="submit" class="btn btn-success" value="Submit">
				</div>			
			</div>
		</form>
		
	</div>				
</div>
@endforeach

@stop