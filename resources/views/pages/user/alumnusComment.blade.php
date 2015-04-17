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
	<h3 class="panel-title">Comment for Alumnus</h3>
</div>
<div class="panel-body">
	<div>
		<div class="row">
			<div class="col-md-6">วิชา : XXXXXXXXXXXX</div>
			<div class="col-md-6"></div>			
		</div>
		<br>
		<br>
		<form action="">
			<div class="row">
				<div class="col-md-6">
					<input type="checkbox" name="vehicle" value=""> Programmer<br>
				</div>
				<div class="col-md-6">
					<input type="checkbox" name="vehicle" value=""> DBA<br>
				</div>			
			</div>
		</form>
		<br>
		<br>
		<div class ="alumnusComment-submit">
			<input type="submit" class="btn btn-success" value="submit" />
		</div>
	</div>				
</div>

@stop