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
		<h1>Reserveren</h1>
	</div>
	<div class="col-md-6 col-md-offset-3 text-center">

		<h2>Categoriën</h2>
		<div class="form-group">
			<select class="form-control text-center" id="categorySelect">
			@forelse($categories as $categorie)
					<option class="text-center" value="{{$categorie->id}}">{{{ucfirst($categorie->name)}}}</option>
				@empty
					<option value="0"></option>
			@endforelse
			</select>
		</div>
	</div>
	<div class="col-md-12">
	@forelse($categories as $categorie)
		<div class="category" id="category{{$categorie->id}}">
			<h3 class="subTitle">{{{ucfirst($categorie->name)}}}</h3>
			<div class="categoryfull span4Container">
				<div class="col-md-4 col-sm-6 col-xs-12 span4">
					<p>Hier komt de kalender bitch.</p>
				</div>
				@forelse($categorie->materials as $material)
					<!-- Some javascript magic later -->
				@empty
					<p>Whaat geen materiaal?!</p>
				@endforelse
			</div>
		</div>
	@empty
		<div class="nocategory">
			<p>Oeps looks there is a problem please contact webmaster and let him do some more magic.</p>
		</div>
	@endforelse	
	</div>	
@stop