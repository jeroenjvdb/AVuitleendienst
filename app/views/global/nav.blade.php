<?php
	function setActive($route, $class = 'active') 
	{
		return (Route::current()->uri() == $route) ? $class : '';
	}
?>
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

	@if(Auth::user()->type == "monitor")
	<li role="presentation">
		<a href="#">Logboek</a>
	</li>
	
	@elseif(Auth::user()->type == "teacher" || Auth::user()->type == "admin")
	<li role="presentation">
		<a href="#">Logboek</a>
	</li>
	<li role="presentation">
		<a href="/beheer">Beheer</a>
	</li>
	
	@endif
	
	<li role="presentation">
		<a href="/logout">Afmelden</a>
	</li>
</ul>

<div class="nav-bars">
{{ HTML::image('assets/images/bars.png', 'alt-text') }}
</div>
<div class="nav-bars-menu"></div>