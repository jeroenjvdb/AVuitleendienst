@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	<h1>{{{$material->name}}}</h1>
	<span class="detailavailability">Beschikbaarheid</span>
	<button class="btn">Reserveren</button>
	<div class="well well-sm col-sm-12">
		<div class="col-sm-6">
			<img src="/images/{{$material->image}}" alt="">
		</div>
		<div class="col-sm-6">
			<p>{{{$material->details}}}</p>
		</div>
		<h2 class="indexacctitle">Accessoires</h2>
		<div class="col-sm-12">
		@forelse($material->accessories as $accessorie)
			<a href="{{$app['url']->to('/')}}/materials/{{$accessorie->id}}">
				<div class="col-sm-3">
					<h3>{{{$accessorie->name}}}</h3>
					<img src="/images/{{$accessorie->image}}" alt="">
					<p>{{{$accessorie->details}}}</p>
				</div>
			</a>
		@empty
			<p>Geen accessoires voor dit item.</p>
		@endforelse
		</div>

		<h2>Andere suggesties</h2>
		<div class="col-sm-12">
			@foreach($material->categories as $categorie)
				@forelse($categorie->materials as $catMaterial)
					@if($material->id != $catMaterial->id)
					<a href="{{$app['url']->to('/')}}/materials/{{$catMaterial->id}}">
						<div class="col-sm-3">
							<h3> {{{$catMaterial->name}}}</h3>
							<img src="/images/{{$catMaterial->image}}" alt="">
							<p>{{{$catMaterial->details}}}</p>
						</div>
					</a>
					@endif
				@empty
				<p>Geen gerelateerde items gevonden.</p>
				@endforelse
			@endforeach
		</div>
		
		</div>
	</div>


	<!-- <h2>{{{$material->name}}}</h2>
	
	
	
	<h2>Accessoires</h2>
	@forelse($material->accessories as $accessorie)
	<a href="{{$app['url']->to('/')}}/materials/{{$accessorie->id}}">
		<div>
			
				
		</div>
	</a>	
	@empty
		<p>Er zijn geen accesores voor dit object.</p>
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
	@endforeach -->
@stop