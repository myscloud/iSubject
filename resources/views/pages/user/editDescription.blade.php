@extends('master')
@section('menu')
<div class="list-group">
	<a href="{{ URL::to('profile') }}" class="list-group-item">Profile</a>
	<a href="{{ URL::to('search') }}" class="list-group-item">Search</a>
	@if(Auth::user()->type == 1 || Auth::user()->type == 2)	
	<a href="{{ URL::to('calendar') }}" class="list-group-item">Calendar</a>
	@endif
	<a href="{{ URL::to('courseList') }}" class="list-group-item">Courselist</a>
	
</div>
@stop
@section('content')

@foreach($comment as $comm)
<div class="panel-heading">
	<h3 class="panel-title">{{ $comm->course_name }}</h3>
</div>
<div class="panel-body">
	<h3>Edit Course Description</h3>
	<br>
	@if($perm == 1)
	<form method="post" action="/editDescription">
		<input name="_token" hidden value="{!! csrf_token() !!}" />
		<input name="course_id" type="hidden" value="{{$comm->course_id}}">
		<div class ="row">
			<div class="col-md-1"></div>
			<div class="col-md-6">
				<textarea class ="editDescription-textArea-field" name="comment">{{$comm->course_des}}</textarea>
			</div>
			<div class="col-md-5"></div>
		</div>
		<br><br>
		<div class ="row">
			<div class="col-md-8"></div>
			<div class="col-md-4">
				<div class ="editDescription-submit-button">
					<input type="submit" class ="btn btn-success" value="submit">
				</div>
			</div>
		</div>

	</form>
	@elseif($perm == 0)
		ไม่สามารถแก้ไขรายละเอียดของรายวิชานี้ได้
	@endif
</div>
@endforeach

@stop