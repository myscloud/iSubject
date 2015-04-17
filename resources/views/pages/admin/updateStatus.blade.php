@extends('masterAdmin')
@section('menu')
<div class="list-group">
	<a href="{{ URL::to('addUser') }}" class="list-group-item">Add User</a>
	<a href="{{ URL::to('updateStatus') }}" class="list-group-item">Update User</a>
	<a href="{{ URL::to('addStudent') }}" class="list-group-item">Add Student to Course</a>
	<a href="{{ URL::to('addCourse') }}" class="list-group-item">Add Course</a>
	<a href="{{ URL::to('addSection') }}" class="list-group-item">Add Section</a>
	<a href="{{ URL::to('updateSection') }}" class="list-group-item">Update Section</a>
	<a href="{{ URL::to('addEvent') }}" class="list-group-item">Add Event</a>
</div>
@stop
@section('content')

<div class="panel-heading">
	<h3 class="panel-title">Change status</h3>
</div>
<div class="panel-body">	
	<br>
	<div class ="updateStatus-studentId-feild">
		Id : <input type="text" class="form-control" placeholder="Id" aria-describedby="basic-addon2">
	</div>
	<br>
	<br>
	<div class ="updateStatus-submit">
		<button type="button" class="btn btn-success">Graduated</button>
	</div>
	<br>
	<br>
</div>


@stop