@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Categorie Toevoegen</h1>
	</div>
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
			{{Form::text('name','',array('required' => 'required','class' => 'form-control'))}}
		</div>
		<br>
		<div class="loginbox">
		{{Form::submit('Toevoegen',array('class' => 'btn btnreg btn-success btn-default'))}}
		</div>
		{{Form::close()}}
	</div>

@stop