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
<form method="post" action="/editStudentInCourse">
	<input name="_token" hidden value="{!! csrf_token() !!}" />
	<div class="panel-heading">
		<h3 class="panel-title">Delete student from section</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<br>
				<div class ="updateSection-courseId-feild">
					Course Id : <input type="text" class="form-control" placeholder="Course id" aria-describedby="basic-addon2" name="c_id">
				</div>
			</div>
			<div class="col-md-6">
				<br>
				<div class ="updateSection-sectionNo-feild">
					Section : <input type="text" class="form-control" placeholder="Section" aria-describedby="basic-addon2" name="sec">
				</div>
			</div>			
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<br>
				<div class ="addSection-year-feild">
					Academic Year : <input type="text" class="form-control" placeholder="Academic Year" aria-describedby="basic-addon2" name="year">
				</div>
			</div>
			<div class="col-md-6">
				<br>
				<div class ="addSection-semester-feild">
					Semester : <input type="text" class="form-control" placeholder="Semester" aria-describedby="basic-addon2" name="semester">
				</div>
			</div>			
		</div>
		<br>
		<br>
		<div class ="updateSection-studentId-feild">
			Id : <input type="text" class="form-control" placeholder="Student id" aria-describedby="basic-addon2" name="stu_id">
		</div>
		<br>
		<br>
		<div class ="updateSection-submit">
			<input type="submit" class="btn btn-success" value="submit" />
		</div>


	</div>
</form>


@stop