<?php
	function setActive($route, $class = 'active') 
	{
		return (Route::current()->uri() == $route) ? $class : '';
	}
?>
<ul class="nav nav-pills" multilinks-noscroll="true">
	<li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
		<a href="/materials" multilinks-noscroll="true">Reserveren</a>
	</li>
	<li role="presentation" class="dropdown">
		<a>Materiaal</a>
		<ul class="dropdownMenu">
			<li><a href="/inchecken">Checkin</a></li>
			<li><a href="/uitchecken">Checkout</a></li>
		</ul>
	</li>

	@if(Auth::user()->type == "monitor")
	<li class="{{setActive('beheer')}} dropdown" role="presentation">
		<a>Beheer</a>
		<ul class="dropdownMenu">
			<li><a href="/logbook">Logboek</a></li>
		</ul>
	</li>
	
	@elseif(Auth::user()->type == "teacher" || Auth::user()->type == "admin")
	<li class="{{setActive('beheer')}} dropdown" role="presentation">
		<a>Beheer</a>
		<ul class="dropdownMenu">
			<li><a href="/beheer/materiaal">Materiaal</a></li>
			<li><a href="/beheer/gebruikers">Studenten</a></li>
			<li><a href="/logbook">Logboek</a></li>
			<li><a href="{{ route('notifications.create') }}">notifications</a></li>
		</ul>
	</li>
	
	@endif
	
	<li role="presentation" class="dropdown">
		<a>{{Auth::user()->firstname}}</a>
		<ul class="dropdownMenu">
			<li><a href="/reservations">Reservaties</a></li>
			<li><a href="/logout">Afmelden</a></li>
		</ul>
	</li>
</ul>

<div class="nav-bars">
{{ HTML::image('assets/images/bars.png', 'alt-text') }}
</div>
<div class="nav-bars-x">
{{ HTML::image('assets/images/barsx.png', 'alt-text') }}
</div>
<div class="nav-bars-menu"></div>