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

@foreach($course as $cou)
<div class="panel-heading">
	<h3 class="panel-title">Comment on {{ $cou->course_name }}</h3>
</div>
<div class="panel-body">
	<div class ="searchCommentPanel">

		<form method="post" action="/viewComment/{{ $cou->course_id }}">
			<input name="_token" hidden value="{!! csrf_token() !!}" />
			<div class="row">
				<div class="col-md-3">
					<div class ="setionComment-feild">
						Section : <input type="text" class="form-control" placeholder="Section" aria-describedby="basic-addon2" name="section"
						@if(isset($section)) @if($section!= "NULL") value="{{$section}}" @endif @endif >
					</div>
				</div>
				<div class="col-md-3">
					<div class ="semesterComment-feild">
						Semester : <input type="text" class="form-control" placeholder="Semester" aria-describedby="basic-addon2" name="semester"
						@if(isset($semester)) @if($semester != "NULL") value="{{$semester}}" @endif @endif >
					</div>
				</div>	
				<div class="col-md-3">
					<div class ="academicYearComment-feild">
						Year : <input type="text" class="form-control" placeholder="Year" aria-describedby="basic-addon2" name="year"
						@if(isset($year)) @if($year != "NULL") value="{{$year}}" @endif @endif >
					</div>
				</div>
				<div class="col-md-1">
					<div class ="searchComment">
						<br>
						<input type="submit" class="btn btn-success" value="search">
					</div>
				</div>			
				<div class="col-md-2">
					
				</div>	
			</div>
		</form>
	</div>

	<br>
	<div>
		@if(sizeof($comment) == 0)
			ไม่พบความคิดเห็นที่มีเงื่อนไขตรงกับที่ท่านค้นหา
		@endif

		@foreach($comment as $comm)
		<div class="panel panel-default">	
				<div class="panel-heading">
					<h3 class="panel-title">By : {{$comm->first_name}}  {{$comm->last_name}} on {{$comm->rev_time}}</h3>
				</div>
				<div class="panel-body">
					<div>
						{{$comm->review_content}}
					</div>				
				</div>
		</div>	
		@endforeach

	</div>
	<br>			
</div>
@endforeach

@stop