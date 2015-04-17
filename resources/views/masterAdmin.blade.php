<!doctype html>
<html>
<head>
	{!! HTML::style('css/bootstrap.min.css') !!}
	{!! HTML::style('css/style.css') !!}
	{!! HTML::style('css/animate.css') !!}
	<title>iSubject</title>
	
	<!--Global settings for error and inform message-->
	@if(Session::has('error-message'))
		<script>alert("{{ Session::get('error-message') }}");</script>
	@elseif(Session::has('success-message'))
		<script>alert("{{ Session::get('success-message') }}");</script>
	@endif

	@yield('head')
</head>
<body>

	<div>
		<nav class="navbar navbar-default navbar-fixed-top" >
			<div class="container" >
				<div class ="animated bounceInLeft"><a href="{{ URL::to('/') }}"><img src ="{{asset('/img/banner.png')}}" class="logo" /></a>
				</div>
				
				<div class = "animated bounceInRight">

					<div class="navbar-text">
					&nbsp &nbsp Admin   <br>
						&nbsp &nbsp Name :   &nbsp &nbsp  <br>
						&nbsp &nbsp <a href="{{ URL::to('/') }}" class="navbar-link">[ Log out ]</a>
					</div>

				</div>
			</div>
		</nav>
	</div>
	<div class="body">
		<div class="row">
			<div class="col-md-3"><div class="animated bounceInUp">@yield('menu')</div></div>
			<div class="col-md-8">
				<div class="animated bounceInLeft">
					<div class="panel panel-default">
						@yield('content')
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	

	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<p>Copyright &copy; 2015 &middot; All Rights Reserved &middot; 
			</p>
		</div>
	</nav>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
</html>