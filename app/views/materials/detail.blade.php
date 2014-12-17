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
	
	<h2>accessoires</h2>
	@forelse($material->accessories as $accessorie)
	<a href="{{$app['url']->to('/')}}/materials/{{$accessorie->id}}">
		<div>
			<h3> {{{$accessorie->name}}}</h3>
			<img src="/images/{{$accessorie->image}}" alt="">
			<p>{{{$accessorie->details}}}</p>	
		</div>
	</a>	
	@empty
		<p>er zijn geen accesores voor dit object.</p>
	@endforelse
	<h2>Andere sugesties</h2>
	@foreach($material->categories as $categorie)
		@forelse($categorie->materials as $catMaterial)
			@if($material->id != $catMaterial->id)
			<h3> {{{$catMaterial->name}}}</h3>
			<img src="/images/{{$catMaterial->image}}" alt="">
			<p>{{{$catMaterial->details}}}</p>
			@endif
		@empty
		<p>Geen gerelateerde producten gevonden</p>
		@endforelse
	@endforeach

	{{$cal->generate()}}
@stop