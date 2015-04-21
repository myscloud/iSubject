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
@if(sizeof($regis) == 0)
	คุณไม่สามารถให้ความคิดเห็นต่อรายวิชานี้ได้ เนื่องจากไม่ได้ลงทะเบียนในรายวิชานี้มาก่อน  หรือได้เคยให้ความคิดเห็นไปแล้ว
@endif
@foreach($regis as $course)
	<div>
		<div class="row">
			<div class="col-md-6">วิชา : 
				@foreach($course_name as $name) {{ $name->course_name }} @endforeach 
			</div>
			<div class="col-md-6">Section : {{ $course->reg_sec }}</div>			
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class ="addComment-semester-feild">
					Semester : {{ $course->reg_semester }}
				</div>
			</div>
			<div class="col-md-6">
				<div class ="addComment-year-feild">
					Academic Year : {{ $course->reg_year }}
				</div>
			</div>			
		</div>
		<br>
		<form method="post" action="/addComment">
			<input name="_token" hidden value="{!! csrf_token() !!}" />
			<input type="hidden" name="course_id" value="{{$course->reg_course}}">
			<input type="hidden" name="section" value="{{$course->reg_sec}}">
			<input type="hidden" name="semester" value="{{$course->reg_semester}}">
			<input type="hidden" name="aca_year" value="{{$course->reg_year}}">

			<div class="row">
				<div class = "comment-in">
					<div class="col-md-5">
						Comment : <textarea class="form-control" placeholder="Add your comment" aria-describedby="basic-addon1" rows="5" name="review"></textarea>
					</div>
				</div>
				<div class="col-md-7">
				<br>
					<input type="submit" class="btn btn-success" value="Submit">
				</div>			
			</div>
		</form>
		
	</div>				
@endforeach
</div>

@stop