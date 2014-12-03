@extends("global.base")

@section("page-title")
	Welkom
@stop

@section("content")
	<h1>Inloggen</h1>
	@if(Session::has('err'))
		<div>{{ Session::get('err') }}</div>
    @endif
	{{Form::open(['route' => 'sessions.store'])}}

	{{Form::label('email','Email:')}}
	{{Form::email('email','', array('required' => 'required'))}}

	{{Form::label('password','Password:')}}
	{{Form::password('password','', array('required' => 'required'))}}

	{{Form::submit('Inloggen')}}

	{{Form::close()}}
@stop