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
	<h3 class="panel-title">Comment</h3>
</div>
<div class="panel-body">
	<div class ="searchCommentPanel">



		<div class="row">
			<div class="col-md-3">
				<div class ="setionComment-feild">
					Section : <input type="text" class="form-control" placeholder="Section" aria-describedby="basic-addon2">
				</div>
			</div>
			<div class="col-md-3">
				<div class ="semesterComment-feild">
					Semester : <input type="text" class="form-control" placeholder="Semester" aria-describedby="basic-addon2">
				</div>
			</div>	
			<div class="col-md-3">
				<div class ="academicYearComment-feild">
					Year : <input type="text" class="form-control" placeholder="Year" aria-describedby="basic-addon2">
				</div>
			</div>
			<div class="col-md-1">
				<div class ="searchComment">
					<br>
					<button type="button" class="btn btn-success">search</button>
				</div>
			</div>			
			<div class="col-md-2">
				
			</div>	
		</div>
	</div>

	<br>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">By : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
		</div>	
	</div>
	<br>	
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">By : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
		</div>	
	</div>		
</div>


@stop