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
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">{{{$categorie->name}}}</a></li>
			@empty
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Geen categorieën</a></li>
		@endforelse
	  </ul>
	</div>

	@forelse($categories as $categorie)
		<div class="{{{$categorie->name}}}"></div>
	@empty
		<div class="nocategory"></div>
	@endforelse

	<div>
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
	</div>
@stop