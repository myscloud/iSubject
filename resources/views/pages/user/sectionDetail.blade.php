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
	<h3 class="panel-title">Section Detail</h3>
</div>
<div class="panel-body">


	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-courseId-feild">
				Course Id : 
			</div>
		</div>
		<div class="col-md-4">
			<br>
			<div class ="sectionDetail-section-feild">
				Section :
			</div>
		</div>		
		<div class="col-md-2">
			<br>
			<a href ="{{ URL::to('alumnusComment') }}"><button class ="btn btn-info">Comment</button></a>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-teacher-feild">
				Teacher : 
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-room-feild">
				Room :
			</div>
		</div>			
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-semester-feild">
				Semester : 
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<div class ="sectionDetail-year-feild">
				Academic Year :
			</div>
		</div>			
	</div>
	<br>
	<br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title">Event</h3>
				</div>
				<div class="col-md-2">
					<a href = "{{ URL::to('addEventU') }}"><button class ="btn btn-info">Add Events</button></a>
				</div>			
			</div>

		</div>
		<div class="panel-body">
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">ชื่อ : </h3>
					</div>
					<div class="panel-body">
						<div>
							detail
						</div>				
					</div>

				</div>	
			</div>
			<br>	
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">ชื่อ : </h3>
					</div>
					<div class="panel-body">
						<div>
							detail
						</div>				
					</div>

				</div>	
			</div>		
		</div>
	</div>
</div>


@stop