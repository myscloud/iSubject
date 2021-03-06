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
	<h3 class="panel-title">Section Detail</h3>
</div>
<div class="panel-body">


	<div class="row">
		<div class="col-md-6">
			<br>
			@foreach($course_name as $course)
				<div class ="sectionDetail-courseId-feild">
					Course : {{ $course->course_name }}
				</div>
			@endforeach
		</div>
		<div class="col-md-4">
			<br>
			<div class ="sectionDetail-section-feild">
				Section : {{ $sec }}
			</div>
		</div>		
		<div class="col-md-2">
			<br>
			<a href ="{{ URL::to('alumnusComment') }}"><button class ="btn btn-info">Comment</button></a>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-teacher-feild">
				Teacher : 
				<?php $i = 0; ?>
				@foreach($teachers as $teacher)
					<?php if($i > 0) echo ',  ';  $i++; ?>
					{{ $teacher->first_name }} {{ $teacher->last_name }}
				@endforeach
			</div>
		</div>
		<div class="col-md-6">
			<br>
			@foreach($room as $c_room)
				<div class ="sectionDetail-room-feild">
					Room : {{ $c_room->classroom }}
				</div>
			@endforeach
		</div>			
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-semester-feild">
				Semester : {{ $semester }}
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-year-feild">
				Academic Year : {{ $year }}
			</div>
		</div>			
	</div>
	<br>
	<br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title">Event</h3>
				</div>
				@if($perm == 1)
					<div class="col-md-2">
						<a href = "{{ URL::to('addEvent').'/'.$course_id.'/'.$sec.'/'.$semester.'/'.$year }}"><button class ="btn btn-info">Add Events</button></a>
					</div>			
				@endif
			</div>

		</div>
		<div class="panel-body">
			@foreach($events as $event)
				<a href="/eventDetail/{{$event->event_id}}">
					<div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"> {{$event->event_name}} </h3>
							</div>
							<div class="panel-body">
								<div>
									{{ $event->description }}
								</div>
								<br>
								<div>
									@if(date('Y-m-d', strtotime($event->start_time)) == date('Y-m-d', strtotime($event->end_time)) && $event->isHomework == 0)
										{{date('l, j F Y', strtotime($event->start_time)) }}
										{{ date('H:i', strtotime($event->start_time)) }} -  {{ date('H:i', strtotime($event->end_time)) }}
									@elseif($event->isHomework == 0)
										{{date('l, j F Y, H:i', strtotime($event->start_time)) }} - 
										{{date('l, j F Y, H:i', strtotime($event->end_time)) }}
									@elseif($event->isHomework == 1)
										Due date: {{date('l, j F Y, H:i', strtotime($event->start_time)) }}
									@endif
								</div>				
							</div>

						</div>	
					</div>
				</a>
				<br>	
			@endforeach
		</div>
	</div>
</div>


@stop