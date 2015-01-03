@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> Materiaal</span>
	<h2>Beheer Materiaal</h2>
	<div>
		@if(Session::has('message'))
	        <div>{{ Session::get('message')}}</div>
	    @endif
	</div>
	<div class="loginbox">    
		<a href="/materials/create">
		    <button class="btn btnreg btn-success btn-default">Materiaal toevoegen</button>
		</a>
		<a href="/categories/create">
		    <button class="btn btnreg btn-success btn-default">Categorie toevoegen</button>
		</a>
	</div>
	<div>
	<div>
		@forelse($categories as $categorie)
		<div class="category">
		<h3>{{{$categorie->name}}} 
			{{ Form::open(['route' => ['categories.edit', $categorie->id], 'method' => 'GET']) }}
			<input class="editbutton" type="image" src="../../assets/images/edit.png" alt="EDIT">
			{{ Form::close() }}
			{{ Form::open(['route' => ['categories.destroy', $categorie->id], 'method' => 'delete']) }}
			<input class="editbutton" type="image" src="../../assets/images/delete.png" alt="DELETE">
			{{ Form::close() }}
			<br><br>
		</h3>
		</div>
	</div>
	<div>
			@forelse($categorie->materials as $material)
			<div class="material-item">{{link_to('materials/'.$material->id,$material->name)}}
				{{ Form::open(['route' => ['materials.edit', $material->id], 'method' => 'GET']) }}
				    <div class="floatleft"><input type="image" src="../../assets/images/edit.png" alt="EDIT"></div>
				{{ Form::close() }}
				{{ Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) }}
				    <div class="floatleft"><input type="image" src="../../assets/images/delete.png" alt="DELETE"></div>
				{{ Form::close() }}
				@empty
				<p>Geen materiaal beschikbaar</p>
				@endforelse
				@empty
				<p>Geen categorieën beschikbaar</p>
				@endforelse
			</div>
	</div>
@stop