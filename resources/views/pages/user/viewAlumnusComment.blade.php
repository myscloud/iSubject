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
	@foreach($result as $comment)
		<br>
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">By : {{ $comment->first_name . ' ' . $comment->last_name }} </h3>
				</div>
				<div class="panel-body">
					<div>
						{{ $comment->alum_rev_content }}
						<br><br>
						posted {{ $comment->alum_rev_time }}
					</div>				
				</div>
				
			</div>	
		</div>
	@endforeach		
</div>


@stop