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
	<h3 class="panel-title">Add User</h3>
</div>
<div class="panel-body">	
	<br>
	<!--div class="btn-group">
			<button type="button" class="btn btn-default">Add ...
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<select 
					<li><a href="#">Student</a></li>
					<li><a href="#">Teacher</a></li>
					<li><a href="#">Alumnus</a></li>
				</ul>
			</button>
		</div-->
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				{{ $user_type }}
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="/addUser/student">student</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="/addUser/teacher">teacher</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="/addUser/admin">admin</a></li>
			</ul>
		</div>
		<br>
		<br>
		@if($user_type == "student")
			<form method="post" action="/addUser/student">
		@elseif($user_type == "teacher")
			<form method="post" action="/addUser/teacher">
		@elseif($user_type == "admin")
			<form method="post" action="/addUser/admin">
		@endif
			<input name="_token" hidden value="{!! csrf_token() !!}" />
			<div class ="login-feild">
				Id : <input type="text" class="form-control" placeholder="Id" aria-describedby="basic-addon2" name="user_id">
			</div>
			<br>
			<div class ="login-feild">
				Name :
				<input type="text" class="form-control" placeholder="Name" aria-describedby="basic-addon2" name="fname">
			</div>
			<br>
			<div class ="login-feild">
				Lastname :
				<input type="text" class="form-control" placeholder="Lastname" aria-describedby="basic-addon2" name="lname">
			</div>
			<br>
			<div class ="login-feild">
				Password :
				<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" name="password">
			</div>
			<br>

			@if($user_type == "student" || $user_type == "teacher")
			<div class ="login-feild">
				Address :
				<input type="text" class="form-control" placeholder="Address" aria-describedby="basic-addon2" name="address">
			</div>
			<br>
			<div class ="login-feild">
				Major ID :
				<input type="text" class="form-control" placeholder="Major ID" aria-describedby="basic-addon2" name="major">
			</div>
			<br>
			@endif

			@if($user_type == "student")
			<div class ="login-feild">
				GPAX :
				<input type="text" class="form-control" placeholder="GPAX" aria-describedby="basic-addon2" name="gpax">
			</div>
			<br>
			<div class ="login-feild">
				Advisor ID :
				<input type="text" class="form-control" placeholder="Advisor ID" aria-describedby="basic-addon2" name="advisor_id">
			</div>
			<br>
			@endif

			@if($user_type == "teacher")
			<div class ="login-feild">
				Teacher's room :
				<input type="text" class="form-control" placeholder="Room Number" aria-describedby="basic-addon2" name="room">
			</div>
			<br>
			<div class ="login-feild">
				Position :
				<input type="text" class="form-control" placeholder="Position" aria-describedby="basic-addon2" name="position">
			</div>
			<br>
			<div class ="login-feild">
				Specialize :
				<input type="text" class="form-control" placeholder="Specialize" aria-describedby="basic-addon2" name="specialize">
			</div>
			<br>
			@endif

			<br>
			<div class ="addUser-submit">
				<input type="submit" class="btn btn-success" value="submit" />
			</div>
		</form>
	</div>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="/js/bootstrap.js"></script>
	@stop