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

@foreach($event_result as $event)
<div class="panel-heading">
	<div class="col-md-10">
		<h3 class="panel-title">รายละเอียดกิจกรรม {{ $event->event_name }} </h3>
	</div>
	<div clas="col-md-2">
		@if($edit_perm == 1)
			<a href = "{{ URL::to('editEvent') }}/{{$event->event_id}}"><button class ="btn btn-info">Edit Events</button></a>
		@endif
		&nbsp;
	</div>
</div>
<div class="panel-body">
	<div>
		<div class ="eventDetail-eventName-feild"><b>Name</b>  {{ $event->event_name }}</div>
		@foreach($course_result as $course)
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-courseName-feild"><b>Course</b> {{ $course->course_name }}</div>
			</div>
			<div class="col-md-6">
				<br>
				<div class ="eventDetail-sectionNo-feild"><b>Section</b>
					<?php $i = 0; ?>
					@foreach($section_result as $section)
						<?php if($i > 0) echo ', '; $i++; ?>
						{{$section->event_sec}}
					@endforeach
				</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-courseName-feild"><b>Semester</b> {{ $course->event_semester }}</div>
			</div>
			<div class="col-md-6">
				<br>
				<div class ="eventDetail-sectionNo-feild"><b>Academic Year</b> {{ $course->event_aca_year }} </div>
			</div>			
		</div>
		@endforeach
		<br>
		<div class ="eventDetail-description-feild"><b>Description</b><br>{{$event->description}}</div>

		@if($event->isHomework == 0 && $same_date == 0)
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-startTime-feild"><b>Start</b> {{date('l, j F Y, H:i', strtotime($event->start_time)) }}</div>
			</div>
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-endTime-feild"><b>End</b> {{date('l, j F Y, H:i', strtotime($event->end_time)) }}</div>
			</div>			
			<div class="col-md-4">
			</div>			
		</div>
		@elseif($event->isHomework == 0 && $same_date == 1)
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-startTime-feild">{{date('l, j F Y', strtotime($event->start_time)) }}</div>
			</div>
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-endTime-feild"> 
					{{ date('H:i', strtotime($event->start_time)) }} -  {{ date('H:i', strtotime($event->end_time)) }}
				</div>
			</div>			
			<div class="col-md-4">
			</div>			
		</div>
		@elseif($event->isHomework == 1)
		<div class="row">
			<div class="col-md-4">
				<br>
				<div class ="eventDetail-startTime-feild"><b>Due date</b> {{date('l, j F Y, H:i', strtotime($event->start_time)) }} </div>
			</div>
			<div class="col-md-4">
			</div>			
			<div class="col-md-4">
			</div>			
		</div>
		@endif
		<br>
	</div>				
</div>
@endforeach

@stop