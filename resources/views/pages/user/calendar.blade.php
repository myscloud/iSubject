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
	<h3 class="panel-title">Calendar</h3>
</div>
<div class="panel-body">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default calendar">
				<div class="panel-heading">
					<h3 class="panel-title">Date</h3>
				</div>
				<div class="panel-body">

					<div >
					<a href="{{ URL::to('eventDetail') }}"class="calendarEvent">[Event]xxxxxxxxxxxxxxxxxxxx</a>
					<br>
					</div>
					<div >
					<a href="{{ URL::to('eventDetail') }}"class="calendarHomework">[Homework]xxxxxxxxxxxxx</a>
					<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default">Last month</button>
		<button type="button" class="btn btn-default">Next month</button>
	</div>
</div>

@stop