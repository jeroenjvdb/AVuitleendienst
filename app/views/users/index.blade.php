@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Welkom, {{Auth::user()->firstname}}</h2>
	

	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
	    Categorieën
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	  	@forelse($categories as $categorie)
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="{{{$categorie->id}}}" class="category">{{{$categorie->name}}}</a></li>
			@empty
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Geen categorieën</a></li>
		@endforelse
	  </ul>
	</div>

	@forelse($categories as $categorie)
		<div class="categoryfull {{{$categorie->id}}} row">
			@forelse($categorie->materials as $material)
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="thumbnail loginbox loginboxinner loginboxshadow">
					<a class="item" href="{{$app['url']->to('/')}}/materials/{{$material->id}}" class="item">
						<h3 class="primaryblue">{{{$material->name}}}</h3>
						<img src="/images/{{$material->image}}" alt="">
					</a>
					
				</div>
			</div>
			
			
			@empty
			<p>geen materiaal</p>
			@endforelse
		</div>
	@empty
		<div class="nocategory">
			<p>There's no category here; Helloooo? ooo? oo?</p>
		</div>
	@endforelse

	<!-- <div>
		@forelse($categories as $categorie)
		<h3>{{{$categorie->name}}}</h3>
			@forelse($categorie->materials as $material)
			{{link_to('materials/'.$material->id,$material->name)}}
			<img src="/images/{{$material->image}}" alt="">
			@empty
			<p>geen materiaal</p>
			@endforelse
		@empty
		<p>geen categorien</p>
		@endforelse
	</div> -->
@stop