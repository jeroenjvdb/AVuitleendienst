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
@stop