@extends('master')
@section('menu')
<div class="list-group">
	<a href="{{ URL::to('profile') }}" class="list-group-item">Profile</a>
	<a href="{{ URL::to('search') }}" class="list-group-item">Search</a>
	<a href="{{ URL::to('calendar') }}" class="list-group-item">Calendar</a>
	<a href="{{ URL::to('courseList') }}" class="list-group-item">Courselist</a>
	
</div>
@stop
@section('content')

<div class="panel-heading">
	<h3 class="panel-title">Comment</h3>
</div>
<div class="panel-body">

	<br>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">By : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
			
		</div>	
	</div>
	<br>	
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">By : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
			
		</div>	
	</div>		
</div>


@stop