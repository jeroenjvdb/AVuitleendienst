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
	<div>
		<a href="/materials/create">Materiaal toevoegen</a>
		<a href="/categories/create">Categorie toevoegen</a>
	</div>
	<div>
		@forelse($categories as $categorie)
		<h3>{{{$categorie->name}}} <a href="#">Edit</a> <a href="#">Delete</a></h3>
			@forelse($categorie->materials as $material)
			<div>{{link_to('materials/'.$material->id,$material->name)}}
				{{ Form::open(['route' => ['materials.edit', $material->id], 'method' => 'GET']) }}
				    <button type="submit" >Edit</button>
				{{ Form::close() }}
				{{ Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) }}
				    <button type="submit" >Delete</button>
				{{ Form::close() }}
			@empty
			<p>geen materiaal</p>
			@endforelse
		@empty
		<p>geen categorien</p>
		@endforelse
	</div>
@stop