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
<form method="post" action="/addCourse">
	<input name="_token" hidden value="{!! csrf_token() !!}" />
	<div class="panel-heading">
		<h3 class="panel-title">Add course</h3>
	</div>
	<div class="panel-body">	
		<br>
		<div class="row">
			<div class="col-md-6">
				<br>
				<div class ="addCourse-courseId-feild">
					Course Id : <input type="text" class="form-control" placeholder="Course id" aria-describedby="basic-addon2" name="course_id">
				</div>
			</div>	
			<div class="col-md-6">
				<br>
				<div class ="addCourse-courseName-feild">
					Course Name : <input type="text" class="form-control" placeholder="Course name" aria-describedby="basic-addon2" name="course_name">
				</div>
			</div>		
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<br>
				<div class ="addCourse-courseMajor-feild">
					Course Major : <input type="text" class="form-control" placeholder="Course major" aria-describedby="basic-addon2" name="course_major">
				</div>
			</div>	
			<div class="col-md-6">
				<br>
				<div class ="addCourse-courseDescription-feild">
					Description : <input type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon2" name="course_des">
				</div>
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-md-9">
			</div>	
			<div class="col-md-3">
				<br>
				<div class ="addCourse-submit">
					<input type="submit" class="btn btn-success" value="submit" />
				</div>
			</div>
		</div>	
		
	</div>



</form>

@stop