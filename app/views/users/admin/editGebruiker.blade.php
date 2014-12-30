@extends("global.base")

@section("page-title")
	{{$gebruiker->firstname . ' ' . $gebruiker->lastname . ' wijzigen'}}
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer</a>><a href="/beheer/gebruikers">Gebruikers</a>>Wijzigen gebruiker</span>
	<h2>'{{$gebruiker->firstname . ' ' . $gebruiker->lastname}}' wijzigen</h2>
	<div>
		{{Form::open(['route' => ['users.update', $gebruiker->id], "method" => "PUT"])}}
		<div>
			{{Form::label('email','E-mail:')}}
			{{Form::text('email', $gebruiker->email, array('required' => 'required', 'placeholder' => 'voorbeeld@mail.be'))}}
			{{$errors->first("email", "<span>:message</span>")}}			
		</div>
		<div>
			{{Form::label('firstname','Voornaam:')}}
			{{Form::text('firstname', $gebruiker->firstname, array('required' => 'required', 'placeholder' => 'Jan'))}}
			{{$errors->first("firstname", "<span>:message</span>")}}		
		</div>
		<div>
			{{Form::label('lastname','Achternaam:')}}
			{{Form::text('lastname', $gebruiker->lastname, array('required' => 'required', 'placeholder' => 'Janssens'))}}
			{{$errors->first("lastname", "<span>:message</span>")}}		
		</div>
		<div>
			{{Form::label('type','Type account:')}}
			{{Form::select('type', ["teacher" => "Leerkracht", "monitor" => "Monitor", "student" => "Student"], $gebruiker->type)}}
			{{$errors->first("type", "<span>:message</span>")}}		
		</div>

		{{Form::submit('Wijzigen')}}
		{{Form::close()}}
	</div>
@stop