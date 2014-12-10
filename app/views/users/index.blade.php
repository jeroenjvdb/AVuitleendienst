@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Welkom, {{Auth::user()->firstname}}</h2>
	<div>
		@forelse($categories as $categorie)
		<h3>{{{$categorie->name}}}</h3>
			@forelse($categorie->materials as $material)
			{{link_to('materials/'.$material->id,$material->name)}}
			@empty
			<p>geen materiaal</p>
			@endforelse
		@empty
		<p>geen categorien</p>
		@endforelse
	</div>
@stop