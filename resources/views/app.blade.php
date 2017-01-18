<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/components.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/app.css') }}" rel="stylesheet">
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

	<load-template url="build/views/templates/menu.html"></load-template>
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
		<script src="{{ asset('build/js/vendor/http-auth-interceptor.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/dirPagination.js') }}"></script>
		<!-- app -->
		<script src="{{ asset('build/js/app.js') }}"></script>
		<script src="{{ asset('build/js/controllers/login.js') }}"></script>
		<script src="{{ asset('build/js/controllers/login-modal.js') }}"></script>
		<script src="{{ asset('build/js/controllers/home.js') }}"></script>
		<script src="{{ asset('build/js/controllers/menu.js') }}"></script>
		<!-- client -->
		<script src="{{ asset('build/js/controllers/client/dashboard.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/delete.js') }}"></script>
		<!-- project -->
		<script src="{{ asset('build/js/controllers/project/dashboard.js') }}"></script>
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
		<!-- project task -->
		<script src="{{ asset('build/js/controllers/project-task/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/create.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/edit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/delete.js') }}"></script>
		<!-- project member -->
		<script src="{{ asset('build/js/controllers/project-member/index.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-member/delete.js') }}"></script>
		<!-- directives -->
		<script src="{{ asset('build/js/directives/project-file-download.js') }}"></script>
		<script src="{{ asset('build/js/directives/form-login.js') }}"></script>
		<script src="{{ asset('build/js/directives/load-template.js') }}"></script>
		<script src="{{ asset('build/js/directives/menu-activated.js') }}"></script>
		<!-- filters -->
		<script src="{{ asset('build/js/filters/date-br.js') }}"></script>
		<!-- services -->
        <script src="{{ asset('build/js/services/oauth-fix-interceptor.js') }}"></script>
		<script src="{{ asset('build/js/services/url.js') }}"></script>
		<script src="{{ asset('build/js/services/user.js') }}"></script>
		<script src="{{ asset('build/js/services/client.js') }}"></script>
		<script src="{{ asset('build/js/services/project.js') }}"></script>
		<script src="{{ asset('build/js/services/project-note.js') }}"></script>
		<script src="{{ asset('build/js/services/project-file.js') }}"></script>
		<script src="{{ asset('build/js/services/project-task.js') }}"></script>
		<script src="{{ asset('build/js/services/project-member.js') }}"></script>
	@else
		<script src="{{ elixir('js/all.js') }}"></script>
	@endif
</body>
</html>
