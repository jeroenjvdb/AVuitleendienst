<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield("page-title") - KdG Uitleendienst </title>
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