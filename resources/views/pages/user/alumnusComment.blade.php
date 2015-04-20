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
	<h3 class="panel-title">Comment for Alumnus</h3>
</div>

@foreach($course as $co)
<div class="panel-body">
	<div>
		<div class="row">
			<div class="col-md-6">วิชา : {{ $co->course_name }}</div>
			<div class="col-md-6"></div>			
		</div>
		<br>
		<br>
		<?php $i = 0; ?>
		<form method="post" action="/occupationVote">
			<input name="_token" hidden value="{!! csrf_token() !!}" />
			<input name="course_id" type="hidden" value="{{$co->course_id}}" />

			@foreach($result as $ov)
				<?php 
					if($i > 0 && $i % 2 == 0) echo '</div> <br>';
					if($i % 2 == 0) echo '<div class="row">';
					$i++;
				?>
				<div class="col-md-6">
					<input type="checkbox" name="occ[]" value="{{$ov->occ_id}}" <?php if($ov->vote == 1) echo 'checked'; ?> >
					{{ $ov->occ_name }} <br>
				</div>
			@endforeach		
			</div>
			<br>
		<br>
		<div class ="alumnusComment-submit">
			<input type="submit" class="btn btn-success" value="submit" />
		</div>
		</form>
	</div>				
</div>
@endforeach
@stop