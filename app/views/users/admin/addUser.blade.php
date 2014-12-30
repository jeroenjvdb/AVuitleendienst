@extends("global.base")

@section("page-title")
	Nieuwe gebruiker
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer</a>><a href="/beheer/gebruikers">Gebruikers</a>>Nieuwe gebruiker</span>
	<h2>Nieuwe gebruiker</h2>
	<div>
		{{Form::open(['route' => 'users.store'])}}
		<div>
			{{Form::label('email','E-mail:')}}
			{{Form::text('email', null, array('required' => 'required', 'placeholder' => 'voorbeeld@mail.be'))}}
			{{$errors->first("email", "<span>:message</span>")}}			
		</div>
		<div>
			{{Form::label('password','Wachtwoord:')}}
			{{Form::password('password', array('required' => 'required', 'placeholder' => 'wachtwoord'))}}
			{{$errors->first("password", "<span>:message</span>")}}			
		</div>
		<div>
			{{Form::label('firstname','Voornaam:')}}
			{{Form::text('firstname', null, array('required' => 'required', 'placeholder' => 'Jan'))}}
			{{$errors->first("firstname", "<span>:message</span>")}}		
		</div>
		<div>
			{{Form::label('lastname','Achternaam:')}}
			{{Form::text('lastname', null, array('required' => 'required', 'placeholder' => 'Janssens'))}}
			{{$errors->first("lastname", "<span>:message</span>")}}		
		</div>
		<div>
			{{Form::label('type','Type account:')}}
			{{Form::select('type', ["teacher" => "Leerkracht", "monitor" => "Monitor", "student" => "Student"])}}
			{{$errors->first("type", "<span>:message</span>")}}		
		</div>

		{{Form::submit('Toevoegen')}}
		{{Form::close()}}
	</div>
@stop