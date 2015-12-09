@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<!--<h1>Welkom, {{Auth::user()->firstname}}</h1>-->
		<h1>Overzicht Apparatuur</h1>
	</div>
	<div class="col-md-12 indexmain">
		<div class="dropdown col-lg-2 col-md-2 col-sm-6 col-xs-6">
		  <button class="btn btnstyle dropdown-toggle indexinput" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		    Categorieën
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu border" role="menu" aria-labelledby="dropdownMenu1">
		  	@forelse($categories as $categorie)
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="{{{$categorie->id}}}" class="category">{{{$categorie->name}}}</a></li>
				@empty
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Geen categorieën</a></li>
			@endforelse
		  </ul>
		</div>
		
		<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
			<input type="search" class="filter btnstyle indexinput form-control" placeholder="Filter op naam">
		</div>
	</div>
	
	

	<div>
		@forelse($categories as $categorie)
			<h2 class="subTitle">{{{$categorie->name}}}</h2>
			<div class="categoryfull {{{$categorie->id}}} span4Container">
				@forelse($categorie->materials as $material)
				<div class="col-md-4 col-sm-6 col-xs-12 span4">
					<div class="thumbnail">
						<a class="item" href="{{$app['url']->to('/')}}/materials/{{$material->id}}" class="item">
							<h3 class="primaryblue haystack">{{{$material->name}}}</h3>
							<img src="/images/{{$material->image}}" alt="{{{$material->name}}}" class="img-rounded">
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
	</div>

@stop