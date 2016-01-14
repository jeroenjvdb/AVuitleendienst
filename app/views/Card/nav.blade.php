<?php
	function setActive($route, $class = 'active') 
	{
		return (Route::current()->uri() == $route) ? $class : '';
	}
?>
<ul class="nav nav-pills" multilinks-noscroll="true">
	<li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
		<a href="/inchecken"><i class="fa fa-sign-in fa-fw"></i> Checkin</a>
	</li>
	<li>
		<li><a href="/uitchecken"><i class="fa fa-sign-out fa-fw"></i> Checkout</a></li>

	</li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
	<li class="{{setActive('materials')}}" role="presentation" multilinks-noscroll="true">
		<a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Afmelden</a>
	</li>
</ul>

<div class="nav-bars">
{{ HTML::image('assets/images/bars.png', 'alt-text') }}
</div>
<div class="nav-bars-x">
{{ HTML::image('assets/images/barsx.png', 'alt-text') }}
</div>
<div class="nav-bars-menu"></div>