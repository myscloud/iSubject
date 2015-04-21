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
<div class="panel-heading">
	<h3 class="panel-title">รายละเอียดวิชา</h3>
</div>
<div class="panel-body">
	@foreach($result as $user)
	<div>
		<div class ="profile-id-feild">รหัสประจำตัว <br> {{ $user->id }} </div>
		<div class ="profile-name-feild">ชื่อ นามสกุล <br> {{ $user->first_name }} {{ $user->last_name}}</div>
		<div class ="profile-address-feild">ที่อยู่ <br> {{ $user->address }} </div>
		<div class ="profile-major-feild">ภาควิชา <br> 
			@foreach($major as $maj) {{ $maj->major_name }} {{ $maj->faculty_name }} @endforeach
			<br></div>
			
			@if(Auth::user()->type == 1)
			@foreach($indiv as $info)
			<div class ="profile-gpax-feild">เกรด <br> {{ $info->gpax }}</div>
			@endforeach
			@endif

			@if(Auth::user()->type == 2)
			@foreach($indiv as $info)
			<div class ="profile-room-feild">ห้องพัก <br> {{ $info->tea_room }} </div>
			<div class ="profile-position-feild">ตำแหน่งทางวิชาการ <br> {{ $info->position }} </div>
			<div class ="profile-skill-feild">ความเชี่ยวชาญ <br> {{ $info->specialize }} </div>
			@endforeach
			@endif

			@if(Auth::user()->type == 3)
			<div class ="profile-occupation-feild">อาชีพ <br>
				@foreach($indiv as $info)
				{{ $info->occ_name }} <br>
				@endforeach
			</div>
			@endif

			<a href="{{ URL::to('changePassword') }}"><button type="button" class="btn btn-default">Change password</button></a>

		</div>
		@endforeach				
	</div>

	@stop