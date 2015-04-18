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
	<form method="post" action="/updateStatus">
		<input name="_token" hidden value="{!! csrf_token() !!}" />
		<div class ="updateStatus-studentId-feild">
			Id : <input type="text" class="form-control" placeholder="Id" aria-describedby="basic-addon2" name="user_id">
		</div>
		<br>
		<br>
		<div class ="updateStatus-submit">
			<input type="submit" class="btn btn-success" value="Graduated">
		</div>
	</form>
	<br>
	<br>
</div>


@stop