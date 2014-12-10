<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield("page-title") - KdG Uitleendienst </title>
	
	{{HTML::script("js/jquery-2.1.1.min.js")}}
	{{HTML::script("js/bootstrap.min.js")}}
	{{HTML::script("https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js")}}
	{{HTML::script("js/main.js")}}
	{{ HTML::style('css/main.css') }}
	
</head>
<body>
	<div class="navbar">
		<a class="navbar-brand" href="/">{{ HTML::image('assets/images/logo.png', 'alt-text') }}</a>
		@yield("nav")
	</div>	
	<div class="container">
		@yield("content")
	</div>	
</body>
</html>