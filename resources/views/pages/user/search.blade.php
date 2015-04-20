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
	<h3 class="panel-title">ค้นหารายวิชา</h3>
</div>
<div class="panel-body">
	<div>
		<div class="row">
			<div class="col-md-6"><div class="search-subj">
				<div class="input-group">
					<form method="post" action="/searchCourseById">
						<input name="_token" hidden value="{!! csrf_token() !!}" />
						<input type="text" class="form-control" placeholder="Search By No." name="course_id">
						<br><br>
						<span class="input-group-btn">
							<input class="btn btn-default" type="submit" value="Search">
						</span>
					</form>
				</div>
			</div>	</div>
			<div class="col-md-6"><div class="search-subj">
				<div class="input-group">
					<form method="post" action="/searchCourseByName">
						<input name="_token" hidden value="{!! csrf_token() !!}" />
						<input type="text" class="form-control" placeholder="Search By Name" name="course_name">
						<br><br>
						<span class="input-group-btn">
							<input class="btn btn-default" type="submit">
						</span>
					</form>
				</div>
			</div>			
		</div>
	</div>
</div>
@if(isset($result))
<div class ="search-rslt">
	Search Result
	<div class="panel-body">
			@foreach($result as $course)
			<div>
				<a href="{{ URL::to('courseDetail') . '/' . $course->course_id }}" >
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">{{ $course->course_id }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $course->course_name }}</h3>
						</div>
						<div class="panel-body">
							<div>
								{{ $course->course_des }}
							</div>				
						</div>

					</div>	
				</a>
			</div>
			@endforeach

		<br>		
	</div>
@endif
</div>

@stop