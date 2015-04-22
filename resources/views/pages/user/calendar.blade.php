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
	<h3 class="panel-title">Calendar {{ $month }} {{ $year }} </h3>
</div>
<div class="panel-body">

	@foreach($calendar as $day)
		@if(sizeof($day['event']) > 0)
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default calendar">
					<div class="panel-heading">
						<h3 class="panel-title">{{ $day['day_of_week'] }}  {{ $day['date'] }}</h3>
					</div>
					
					<div class="panel-body">
						@foreach($day['event'] as $event)
							@if($event->isHomework == 0)
							<div>
							<a href="{{ URL::to('eventDetail') }}/{{$event->event_id}}"class="calendarEvent">[Event] {{$event->course_name}} - {{$event->event_name}}</a>
							<br>
							</div>
							@elseif($event->isHomework == 1)
							<div >
							<a href="{{ URL::to('eventDetail') }}/{{$event->event_id}}"class="calendarHomework">[Homework] {{$event->course_name}} - {{$event->event_name}}</a>
							<br>
							</div>
							@endif
						@endforeach
					</div>
					
				</div>
			</div>
		</div>
		@endif
	@endforeach

	<div class="btn-group" role="group" aria-label="...">
		<a href="/calendar/{{$prev_year}}/{{$prev_mo}}"><button type="button" class="btn btn-default">Last month</button></a>
		<a href="/calendar/{{$next_year}}/{{$next_mo}}"><button type="button" class="btn btn-default">Next month</button></a>
	</div>

</div>

@stop