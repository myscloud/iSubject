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
	<h3 class="panel-title">
		 @if($page_type == 'current')
			วิชาที่ลงทะเบียน
		@elseif($page_type == 'all')
			วิชาที่เคยลงทะเบียน
		@elseif($page_type == 'fav')
			วิชาที่ถูกใจ
		@endif
	</h3>
</div>
<div class="panel-body">
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			@if($page_type == 'current')
				วิชาที่ลงทะเบียน
			@elseif($page_type == 'all')
				วิชาที่เคยลงทะเบียน
			@elseif($page_type == 'fav')
				วิชาที่ถูกใจ
			@endif
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="/courseList">วิชาที่ลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="/courseList/all">วิชาที่เคยลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="/courseList/fav">วิชาที่ถูกใจ</a></li>
		</ul>
	</div>
	<br>
	@foreach($result as $course)
	<div>
		<a href="courseDetail/{{ $course->course_id }}">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> {{ $course->course_name }} </h3>
				</div>
				<div class="panel-body">
					<div>
						{{ $course->course_des }}
					</div>				
				</div>
				
			</div>	
		</a>
	</div>
	<br>
	@endforeach		
</div>


@stop