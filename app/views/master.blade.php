<?php
function setActive($route, $class = 'active') {
return (Route::current()->uri() == $route) ? $class : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		@yield('title')
	</title>
	{{HTML::style("css/main - kopie.css")}}
  {{HTML::script("js/main.js")}}
</head>
<body>

<div class="navbar">
<a class="navbar-brand" href="/">{{ HTML::image('assets/images/logo.png', 'alt-text') }}</a>
  <ul class="nav nav-pills" multilinks-noscroll="true">
    <li class="active" role="presentation" multilinks-noscroll="true">
      <a href="#" multilinks-noscroll="true">Reserveren</a>
    </li>
    <li role="presentation" multilinks-noscroll="true">
      <a href="#" multilinks-noscroll="true">Mijn Reservaties</a>
    </li>
    <li role="presentation">
      <a href="#">Materiaal Uitchecken</a>
    </li>
    <li role="presentation">
      <a href="#">Materiaal Inchecken</a>
    </li>
  </ul>
</div>

	<div class="container">
		@yield('content')	
	</div>
</body>
</html>

