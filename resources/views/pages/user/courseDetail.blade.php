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
	<h3 class="panel-title">รายละเอียดวิชา</h3>
</div>
<div class="panel-body">
	
	<div class ="courseDetail-favorite-button">
		<button class ="btn btn-warning">Favourite</button>
	</div>
	<div>
		<div class ="courseDetail-courseId-feild">รหัสวิชา</div>
		<div class ="courseDetail-courseName-feild">ชื่อวิชา</div>
		<div class ="courseDetail-description-feild">Description<a href="{{ URL::to('editDescription') }}">[Edit]</a></div>
		<div class ="courseDetail-comment-feild">Comment <a href="{{ URL::to('viewComment') }}">[All comments]</a><a href="{{ URL::to('viewAlumnusComment') }}">[All alumnus comments]</a></div>
		
		<a href="{{ URL::to('addComment') }}"><button type="button" class="btn btn-info">Add comment</button></a>
		<div class ="courseDetail-occupation-feild">Occupation</div>
		<div class ="courseDetail-section-dropdown">
			<div class="dropdown">
				<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					Section
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">1</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">2</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">3</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">4</a></li>
				</ul>
			</div>
		</div>

	</div>				
</div>

@stop