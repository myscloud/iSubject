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
					<input type="text" class="form-control" placeholder="Search By No.">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Search
						</button>
					</span>
				</div>
			</div>	</div>
			<div class="col-md-6"><div class="search-subj">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search By Name">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Search
						</button>
					</span>
				</div>
			</div>			
		</div>
	</div>
</div>

<div class ="search-rslt">
	Search Result
	<div class="panel-body">
		<div>
		<a href="{{ URL::to('courseDetail') }}" >
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">รหัสวิชา : xxxxxxx&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspวิชา : xxxxxxx</h3>
					</div>
					<div class="panel-body">
						<div>
							XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
						</div>				
					</div>

				</div>	
			</a>
		</div>
		<br>	
		<div>
		<a href="{{ URL::to('courseDetail') }}" >
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">รหัสวิชา : xxxxxxx&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspวิชา : xxxxxxx</h3>
				</div>
				<div class="panel-body">
					<div>
						XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
					</div>				
				</div>
			</div>	
			</a>
		</div>		
	</div>

</div>

@stop