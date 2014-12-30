@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Beheer</h2>

<div class="loginbox">    
	<a href="/beheer/materiaal">
	    <button class="btn btnreg btn-success btn-default">Materiaalbeheer</button>
	</a>
	<a href="/beheer/gebruikers">
	    <button class="btn btnreg btn-success btn-default">Studentenbeheer</button>
	</a>
</div>

@stop