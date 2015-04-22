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
	<h3 class="panel-title">Add event</h3>
</div>
<div class="panel-body">

	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="addEventU-courseId-feild">
				Course : @foreach($course_name as $course) {{$course->course_name}} @endforeach
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="addEventU-sectionNo-feild">
				Section : {{$section}}
			</div>
		</div>			
	</div>
	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="addEventU-courseId-feild">
				Semester : {{$semester}}
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="addEventU-sectionNo-feild">
				Academic Year : {{$year}}
			</div>
		</div>			
	</div>
	<br><br>

	<form method="post" action = "/addUserEvent">
		<input name="_token" hidden value="{!! csrf_token() !!}" />
		<input type="hidden" name="course_id" value="{{$course_id}}">
		<input type="hidden" name="section" value="{{$section}}">
		<input type="hidden" name="year" value="{{$year}}">
		<input type="hidden" name="semester" value="{{$semester}}">

		<div class ="addEventU-eventName-feild">
			Event name : <br><input type="text" class="form-control" placeholder="Event name" aria-describedby="basic-addon2" name ="event_name">
		</div>
		<br>
		<div class ="addEventU-description-feild">
			Description : <br><input type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon2" name ="event_des">
		</div>
		<br>
		<input type="checkbox" name="homework" value="1">Homework<br>
		<br>
		Start :<br>
		<input type="date" name="startDate"><input type="time" name="startTime">
		<br>
		End :
		<br><input type="date" name="endDate"><input type="time" name="endTime">
		<div class ="addEventU-submit">
			<input type="submit" class="btn btn-success" value="Submit">
		</div>
	</form>

</div>


@stop