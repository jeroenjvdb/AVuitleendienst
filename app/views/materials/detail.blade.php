@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	<h1>{{{$material->name}}}</h1>
	<div>
		@if(Session::has('message') )
			{{Session::get('message')}}
		@endif		
	</div>

	<div class="row">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<img src="/images/{{$material->image}}" alt="{{$material->name}}" class="detailimg">
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<p>{{{$material->details}}}</p>
			</div>
		</div>
		
		<h2 class="indexacctitle">Accessoires</h2>
		<div class="row">
		@forelse($material->accessories as $accessorie)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					<a href="{{$app['url']->to('/')}}/materials/{{$accessorie->id}}">
						<img src="/images/{{$accessorie->image}}" alt="">
						<div class="caption">
							<h3>{{{$accessorie->name}}}</h3>
							<p>{{{$accessorie->details}}}</p>
						</div>
					</a>
				</div>
			</div>
		@empty
			<h4 class="notification">Geen accessoires voor dit item.</h4>
		@endforelse
		</div>

		<h2>Andere suggesties</h2>
		<div class="row">
			@foreach($material->categories as $categorie)
				@forelse($categorie->materials as $catMaterial)
					@if($material->id != $catMaterial->id)
					<div class="col-sm-6 col-md-3">
						<div class="thumbnail">
							<a href="{{$app['url']->to('/')}}/materials/{{$catMaterial->id}}">
								<img src="/images/{{$catMaterial->image}}" alt="">
								<div class="caption">
									<h3> {{{$catMaterial->name}}}</h3>
									<p>{{{$catMaterial->details}}}</p>
								</div>
							</a>
						</div>
					</div>
					@endif
				@empty
				<h4 class="notification">Geen gerelateerde items gevonden.</h4>
				@endforelse
			@endforeach
		</div>
		<a name="calendar"></a>
		{{$cal->generate($material->id)}}
	</div>
@stop