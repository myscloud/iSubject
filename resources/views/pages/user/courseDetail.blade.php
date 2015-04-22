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
@foreach($courseResult as $course)
<div class="panel-heading">
	<h3 class="panel-title">{{ $course->course_name }}</h3>
</div>
<div class="panel-body">
	
	@if(Auth::user()->type == 1)
		@if($is_fav == 0)
			<div class ="courseDetail-favorite-button">
				<a href = "/favourite/{{$course->course_id}}">
					<button class ="btn btn-warning">Add to Favourite</button>
				</a>
			</div>
		@elseif($is_fav == 1)
			<div class ="courseDetail-favorite-button">
				<a href = "/favourite/{{$course->course_id}}">
					<button class ="btn btn-danger">Favourite</button>
				</a>
			</div>
		@endif
	@endif
	<div>
		
		<div class ="courseDetail-courseId-feild"></div>
		<div class ="courseDetail-courseName-feild"><h4>ชื่อวิชา</h4>  {{ $course->course_name }}</div>

		<div class ="courseDetail-description-feild"><h4>Description
			@if($edit_perm == 1)
				<a href="{{ URL::to('editDescription') . '/' . $course->course_id }}">[Edit]</a>
			@endif
			</h4>
			<br> {{ $course->course_des }}
		</div>

		<div class ="courseDetail-comment-feild"><h4>Comment<a href="{{ URL::to('viewComment') . '/' . $course->course_id }}">[All comments]</a><a href="{{ URL::to('viewAlumnusComment'). '/' . $course->course_id }}">[All alumnus comments]</a></h4></div>
		@if(sizeof($stu_rev) == 0 && sizeof($alum_rev) == 0)
			ไม่มีความคิดเห็นสำหรับวิชานี้
		@else
			@foreach($stu_rev as $rev)
				<h5>Latest Student Comment</h5>
				{{ $rev->review_content }} <br>
				by {{$rev->first_name}} {{$rev->last_name}} at {{ $rev->rev_time }}
			@endforeach
			<br><br>
			@foreach($alum_rev as $rev)
				<h5>Latest Alumnus Comment</h5>
				{{ $rev->alum_rev_content }} <br>
				by {{$rev->first_name}} {{$rev->last_name}} at {{ $rev->alum_rev_time }}
			@endforeach
		@endif

		
		@if(Auth::user()->type == 1 and $comm_perm == 1)
			<a href="{{ URL::to('addComment') }}"><button type="button" class="btn btn-info">Add comment</button></a>
		@elseif(Auth::user()->type == 3)
			<a href="{{ URL::to('addCommentAlumnus') . '/' . $course->course_id }}"><button type="button" class="btn btn-info">Add comment</button></a>
		@endif

		<div class ="courseDetail-occupation-feild"><h4>Occupation</h4></div>
		@foreach($occ_vote as $vote)
			<div>{{ $vote->occ_name }}  จำนวนคนโหวต  {{ $vote->vote_count }} คน <br><br></div>
		@endforeach

		@if(Auth::user()->type == 3)
			<a href="{{ URL::to('occupationVote') . '/' . $course->course_id }}"><button type="button" class="btn btn-info">Occupation Vote</button></a>
		@endif


		@if(Auth::user()->type == 1 || Auth::user()->type == 2)
		<div class ="courseDetail-section-dropdown">
			<div class="dropdown">
				<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					Section
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					@foreach($sections as $sec)
						<li role="presentation"><a role="menuitem" tabindex="-1" href="/sectionDetail/{{$sec->course_id_sec}}/{{$sec->sec_num}}/{{$sec->semester}}/{{$sec->aca_year}}">
							{{ $sec->sec_num }}
						</a></li>
					@endforeach
				</ul>
			</div>
		</div>
		@endif

	</div>				
</div>
@endforeach
@stop