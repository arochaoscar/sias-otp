<?php
$listOpc = array();
if(session()->has('options')){
	$listOpc = \Session::get('options');
}
?>
		<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Muronto - OTP</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body >
<nav class="navbar navbar-default bg-blue-light">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">



			</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="/"></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right bg-blue-light">
				@if (Auth::guest())
					<li><a href="/login">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							@foreach( $listOpc as $opcion)
								<li>
									<a href="{{ route($opcion['route']) }}">
										<i class="glyphicon glyphicon-menu-right"></i> {{ $opcion['option'] }}
									</a>
								</li>
							@endforeach
							<li role="separator" class="divider"></li>

							<li>
								<a href="{{ route('exit') }}">
									<i class="glyphicon glyphicon-off"></i> Logout
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>
<div class="muronto-back">
	<div class="content">
			@yield('content')
	</div>
</div>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('scripts')
</body>
</html>
