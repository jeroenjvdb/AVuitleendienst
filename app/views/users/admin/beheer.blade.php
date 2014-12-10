@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Beheer</h2>
	<div>
		<a href="/beheer/materiaal">Beheer materiaal</a>
		<a href="/beheer/gebruikers">Beheer studenten</a>
	</div>
@stop