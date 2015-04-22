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

@foreach($result as $event)
	<?php $event_id = $event->event_id; ?>
@endforeach

<div class="panel-heading">
	<div class="col-md-11">
		<h3 class="panel-title">Edit event</h3>
	</div>
	<div class="col-md-1">
		@if($perm == 1)
			<form method="post" action="/deleteEvent">
				<input name="_token" hidden value="{!! csrf_token() !!}" />
				<input type="hidden" name="event_id" value="{{ $event_id }}">
				<input type="submit" class ="btn btn-danger" value="Delete">
 			</form>
		@endif
	</div>
	&nbsp;
</div>
<div class="panel-body">
@if($perm == 0)
	คุณไม่มีสิทธิ์แก้ไขกิจกรรมนี้
@elseif($perm == 1)
@foreach($result as $event)
	<form method="post" action = "/editEvent">
		<input name="_token" hidden value="{!! csrf_token() !!}" />
		<input name="event_id" type="hidden" value="{{$event->event_id}}">

		<div class ="addEventU-eventName-feild">
			Event name : <br><input type="text" class="form-control" placeholder="Event name" aria-describedby="basic-addon2" name ="event_name" value="{{$event->event_name}}">
		</div>
		<br>
		<div class ="addEventU-description-feild">
			Description : <br><input type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon2" name ="event_des" value="{{$event->description}}">
		</div>
		<br>
		Type: 
		@if($event->isHomework == 1) Homework
		@else Event
		@endif
		<br><br>

		@if($event->isHomework == 1) Due date:
		@else Start :
		@endif
		<br>
		<input type="date" name="startDate" value="{{ Date('Y-m-d', strtotime($event->start_time)) }}">
		<input type="time" name="startTime" value="{{ Date('H:i', strtotime($event->start_time)) }}">
		<br>
		@if($event->isHomework == 0)
			End :
			<br><input type="date" name="endDate" value="{{ Date('Y-m-d', strtotime($event->end_time)) }}">
			<input type="time" name="endTime" value="{{ Date('H:i', strtotime($event->end_time)) }}">
		@endif
		<div class ="addEventU-submit">
			<input type="submit" class="btn btn-success" value="Submit">
		</div>
	</form>

</div>
@endforeach
@endif
@stop