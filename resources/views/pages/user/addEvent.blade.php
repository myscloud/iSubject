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
	<h3 class="panel-title">Add event</h3>
</div>
<div class="panel-body">


	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="addEventU-courseId-feild">
				Course Id : 
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="addEventU-sectionNo-feild">
				Section :
			</div>
		</div>			
	</div>
	<br>
	<div class ="addEventU-eventName-feild">
		Event name : <br><input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2" name ="std_id">
	</div>
	<br>
	<div class ="addEventU-description-feild">
		Description : <br><input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2" name ="std_id">
	</div>
	<br>
	<input type="checkbox" name="Homework" value=""> Homework<br>
	<br>
	Start :<br>
	<input type="date" name="startDate"><input type="time" name="startTime">
	<br>
	End :
	<br><input type="date" name="endDate"><input type="time" name="endTime">
	<div class ="addEventU-submit">
		<button type="button" class="btn btn-success">Submit</button>
	</div>


</div>


@stop