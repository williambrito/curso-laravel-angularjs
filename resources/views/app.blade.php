<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/components.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet">
	@else
		<link href="{{ elixir('css/all.css') }}" rel="stylesheet">
	@endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Welcome</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest())
						@if(!Request::is('auth/login'))
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
						@endif
						@if(!Request::is('auth/register'))
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@endif
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div ng-view></div>

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<!-- vendor -->
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/query-string.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ng-file-upload.min.js') }}"></script>
		<!-- app -->
		<script src="{{ asset('build/js/app.js') }}"></script>
		<script src="{{ asset('build/js/controllers/login.js') }}"></script>
		<script src="{{ asset('build/js/controllers/home.js') }}"></script>
		<!-- client -->
		<script src="{{ asset('build/js/controllers/client/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/delete.js') }}"></script>
		<!-- project -->
		<script src="{{ asset('build/js/controllers/project/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/delete.js') }}"></script>
		<!-- project note -->
		<script src="{{ asset('build/js/controllers/project-note/show.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/delete.js') }}"></script>
		<!-- project file -->
		<script src="{{ asset('build/js/controllers/project-file/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/delete.js') }}"></script>
		<!-- filters -->
		<script src="{{ asset('build/js/filters/date-br.js') }}"></script>
		<!-- services -->
		<script src="{{ asset('build/js/services/user.js') }}"></script>
		<script src="{{ asset('build/js/services/client.js') }}"></script>
		<script src="{{ asset('build/js/services/project.js') }}"></script>
		<script src="{{ asset('build/js/services/project-note.js') }}"></script>
	@else
		<script src="{{ elixir('js/all.js') }}"></script>
	@endif
</body>
</html>
