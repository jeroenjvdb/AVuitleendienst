@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>{{{$material->name}}}</h2>
	<img src="/images/{{$material->image}}" alt="">
	<p>{{{$material->details}}}</p>
@stop