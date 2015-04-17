<!DOCTYPE html>
<html>
<head>
	
	{!! HTML::style('css/bootstrap.min.css') !!}
	{!! HTML::style('css/animate.css') !!}
	{!! HTML::style('css/style.css') !!}
	<title >iSubject</title>

	@if(Session::has('error-message'))
		<script>alert("{{ Session::get('error-message') }}");</script>
	@endif
</head>
<body>
	<form method="post" action="/authenticate">
	<input name="_token" hidden value="{!! csrf_token() !!}" />
	<div class="username-in">
		<!--div class="btn-group">
			<button type="button" class="btn btn-default">Login as ...
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Student</a><input type="hidden" name="types" value="1" /></li>
					<li><a href="#">Teacher</a><input type="hidden" name="types" value="2" /></li>
					<li><a href="#">Alumnus</a><input type="hidden" name="types" value="3" /></li>
				</ul>
			</button>
		</div-->
		<select class="btn btn-default" name="user_type">
 			<option value="1">Student</option>
 			<option value="2">Teacher</option>
 			<option value="3">Alumnus</option>
 			<option value="4">Admin</option>
  		</select>
		<br>
		<br>
		<div class ="login-feild">
			<input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon2" name="user_id">
		</div>
		<br>
		<div class ="login-feild">
			<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" name="password">
		</div>
		<br>
		<div class ="login-submit">
		<input type="submit" class="btn btn-success" value="login" />
		</div>
	</div>
	<br>
	</form>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/script1.js"></script>
</body>
</html>
