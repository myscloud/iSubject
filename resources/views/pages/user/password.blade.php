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
	<h3 class="panel-title">Change Password</h3>
</div>
<div class="panel-body">


	
	<br>
	<form method="post" action="changePassword">
		<input name="_token" hidden value="{!! csrf_token() !!}" />
		<div class ="password-oldPassword-feild">
			old password : <input type="password" class="form-control" placeholder="Old Password" aria-describedby="basic-addon2" name="old_pass">
		</div>
		<br>
		<div class ="password-newPassword-feild">
			new password : <input type="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon2" name="new_pass">
		</div>
		<br>
		<div class ="password-reNewPassword-feild">
		re-new password : <input type="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon2" name="renew_pass">
		</div>
		<br>
		<div class ="password-submit">
			<input type="submit" class="btn btn-success">
		</div>
	</form>

</div>


@stop