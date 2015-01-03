@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> <a href="/beheer/materiaal">Materiaal </a>> Edit Materiaal</span>
	<h2>Edit Materiaal</h2>
	<div>
		{{Form::open(['route' => ['categories.update',$categorie->id],'method' => 'PUT'])}}
		<div>
			{{$errors->first('name')}}
		</div>
		<div>
			{{Form::label('naam','Naam:')}}
			{{Form::text('name',$categorie->name,array('required' => 'required'))}}			
		</div>
		<br>
		{{Form::submit('Wijzigen',array('class' => 'btn btnreg btn-success btn-default'))}}
		{{Form::close()}}
	</div>
@stop