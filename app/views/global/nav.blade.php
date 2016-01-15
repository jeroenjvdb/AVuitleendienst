<?php
	function setActive($route, $class = 'active') 
	{
		return (Route::current()->uri() == $route) ? $class : '';
	}
?>
<ul class="nav nav-pills" multilinks-noscroll="true">
	<li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
		<a href="/materials" multilinks-noscroll="true"><i class="fa fa-calendar fa-fw"></i> Reserveren</a>
	</li>

	@if(Auth::user()->type == "monitor")
	<li class="{{setActive('beheer')}} dropdown" role="presentation">
		<a><i class="fa fa-cogs fa-fw"></i> Beheer <i class="fa fa-chevron-down fa-fw"></i></a>
		<ul class="dropdownMenu">
			<li><a href="/logbook">Logboek</a></li>
		</ul>
	</li>
	
	@elseif(Auth::user()->type == "teacher" || Auth::user()->type == "admin")
	<li class="{{setActive('beheer')}} dropdown" role="presentation">
		<a href="/beheer"><i class="fa fa-cogs fa-fw"></i> Beheer <i class="fa fa-chevron-down fa-fw"></i></a>
		<ul class="dropdownMenu">
			<li><a href="/beheer/materiaal"><i class="fa fa-video-camera fa-fw"></i> Materiaal</a></li>
			<li><a href="/beheer/gebruikers"><i class="fa fa-users fa-fw"></i> Gebruikers</a></li>
			<li><a href="/logbook"><i class="fa fa-sticky-note fa-fw"></i> Logboek</a></li>
			<li><a href="{{ route('notifications.index') }}"><i class="fa fa-bell-o fa-fw"></i> Notificaties</a></li>
		</ul>
	</li>
	
	@endif
	
	<li role="presentation" class="dropdown">
		<a><i class="fa fa-user fa-fw"></i>{{ucfirst(Auth::user()->firstname).' '.ucfirst(Auth::user()->lastname)}} <i class="fa fa-chevron-down fa-fw"></i></a>
		<ul class="dropdownMenu">
			<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
			<li><a href="{{route('myreservations')}}"><i class="fa fa-calendar-check-o fa-fw"></i> Mijn Reservaties</a></li>
			@if(Auth::user()->type == "admin")
				<li><a href="{{ route('setBaseLaptop') }}"><i class="fa fa-desktop"></i> Nieuw basisstation</a></li>
			@endif
			<li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Afmelden</a></li>
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