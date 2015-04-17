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
	<h3 class="panel-title">วิชาที่ลงทะเบียน</h3>
</div>
<div class="panel-body">
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			View
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่เคยลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ถูกใจ</a></li>
		</ul>
	</div>
	<br>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
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
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
			
		</div>	
	</div>		
</div>

<div class="panel-heading">
	<h3 class="panel-title">วิชาที่เคยลงทะเบียน</h3>
</div>
<div class="panel-body">
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			View
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่เคยลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ถูกใจ</a></li>
		</ul>
	</div>
	<br>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
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
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
			</div>
			<div class="panel-body">
				<div>
					XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
				</div>				
			</div>
			
		</div>	
	</div>		
</div>

<div class="panel-heading">
	<h3 class="panel-title">วิชาที่ถูกใจ</h3>
</div>
<div class="panel-body">
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			View
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่เคยลงทะเบียน</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">วิชาที่ถูกใจ</a></li>
		</ul>
	</div>
	<br>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
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
				<h3 class="panel-title">วิชา : XXXXXXX</h3>
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