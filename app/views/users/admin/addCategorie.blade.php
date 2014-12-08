@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Categorie Toevoegen</h1>
	@if(Session::has('message'))
        <div>{{ Session::get('message')}}</div>
    @endif
	<div>
		{{Form::open(['route' => 'categories.store','files' => true])}}
		<div>
			{{ $errors->first('name')}}
		</div>
		<div>
			{{Form::label('name','Naam:')}}
			{{Form::text('name','',array('required' => 'required'))}}
		</div>
		{{Form::submit('verzend')}}
		{{Form::close()}}
	</div>
@stop