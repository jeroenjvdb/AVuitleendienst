<?php
	function setActive($route, $class = 'active') 
	{
		return (Route::current()->uri() == $route) ? $class : '';
	}
?>
<ul class="nav nav-pills loginboxshadow" multilinks-noscroll="true">
	<li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
		<a href="/materials" multilinks-noscroll="true">Reserveren</a>
	</li>
	<li class="{{setActive('reservations')}}"role="presentation" multilinks-noscroll="true">
		<a href="/reservations" multilinks-noscroll="true">Mijn Reservaties</a>
	</li>
	<li role="presentation">
		<a href="/uitchecken">Materiaal Uitchecken</a>
	</li>
	<li role="presentation">
		<a href="/inchecken">Materiaal Inchecken</a>
	</li>

	@if(Auth::user()->type == "monitor")
	<li class="{{setActive('logbook')}}" role="presentation">
		<a href="/logbook">Logboek</a>
	</li>
	
	@elseif(Auth::user()->type == "teacher" || Auth::user()->type == "admin")
	<li class="{{setActive('logbook')}}" role="presentation">
		<a href="/logbook">Logboek</a>
	</li>
	<li class="{{setActive('beheer')}}" role="presentation">
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
<div class="nav-bars-x">
{{ HTML::image('assets/images/barsx.png', 'alt-text') }}
</div>
<div class="nav-bars-menu"></div>