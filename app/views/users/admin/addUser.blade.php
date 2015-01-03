@extends("global.base")

@section("page-title")
	Nieuwe gebruiker
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> <a href="/beheer/gebruikers">Gebruikers </a>> Nieuwe gebruiker</span>
	<h2>Nieuwe gebruiker toevoegen</h2>
	<div>
		{{Form::open(['route' => 'users.store'])}}
		<div>
			{{Form::text('email', null, array('required' => 'required', 'placeholder' => 'Email '))}}
			{{$errors->first("email", "<span>:message</span>")}}			
		</div>
		<div>
			{{Form::password('password', array('required' => 'required', 'placeholder' => 'Wachtwoord '))}}
			{{$errors->first("password", "<span>:message</span>")}}			
		</div>
		<div>
			{{Form::text('firstname', null, array('required' => 'required', 'placeholder' => 'Voornaam '))}}
			{{$errors->first("firstname", "<span>:message</span>")}}		
		</div>
		<div>
			{{Form::text('lastname', null, array('required' => 'required', 'placeholder' => 'Achternaam '))}}
			{{$errors->first("lastname", "<span>:message</span>")}}		
		</div>
		<div>
		<br>
			{{Form::select('type', ["teacher" => "Leerkracht", "monitor" => "Monitor", "student" => "Student"])}}
			{{$errors->first("type", "<span>:message</span>")}}		
		</div>
		<br>
		{{Form::submit('Toevoegen',array('class' => 'btn btnreg btn-success btn-default'))}}
		{{Form::close()}}
	</div>
@stop