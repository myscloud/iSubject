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
	<h3 class="panel-title">รายละเอียดกิจกรรม</h3>
</div>
<div class="panel-body">
	<div>
		<div class ="eventDetail-eventName-feild">Name</div>
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-courseName-feild">Course</div>
			</div>
			<div class="col-md-6">
				<br>
				<div class ="eventDetail-sectionNo-feild">Section</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-startTime-feild">Start</div>
			</div>
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-endTime-feild">End</div>
			</div>			
			<div class="col-md-4">

			</div>			

		</div>
		<br>
		<div class ="eventDetail-description-feild">Description</div>
		
		
		

	</div>				
</div>

@stop