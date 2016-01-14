@extends("global.base")

@section("page-title")
	{{$gebruiker->firstname . ' ' . $gebruiker->lastname . ' wijzigen'}}
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>'{{$gebruiker->firstname . ' ' . $gebruiker->lastname}}' wijzigen</h1>
	</div>
	<div>
		{{Form::open(['route' => ['users.update', $gebruiker->id], "method" => "PUT"])}}
		<div><br>
			{{Form::label('email','E-mail:')}}
			{{Form::text('email', $gebruiker->email, array('required' => 'required', 'placeholder' => 'voorbeeld@mail.be','class' => 'form-control'))}}
			{{$errors->first("email", "<span>:message</span>")}}			
		</div>
		<div><br>
			{{Form::label('firstname','Voornaam:')}}
			{{Form::text('firstname', $gebruiker->firstname, array('required' => 'required', 'placeholder' => 'Jan','class' => 'form-control'))}}
			{{$errors->first("firstname", "<span>:message</span>")}}		
		</div>
		<div><br>
			{{Form::label('lastname','Achternaam:')}}
			{{Form::text('lastname', $gebruiker->lastname, array('required' => 'required', 'placeholder' => 'Janssens','class' => 'form-control'))}}
			{{$errors->first("lastname", "<span>:message</span>")}}		
		</div>
		<div><br>
			{{Form::label('type','Type account:')}}
			{{Form::select('type', ["teacher" => "Leerkracht", "monitor" => "Monitor", "student" => "Student"], $gebruiker->type,array('class' => 'form-control'))}}
			{{$errors->first("type", "<span>:message</span>")}}		
		</div>
		<br>
		{{Form::submit('Wijzigen',array('class' => 'btn btnreg btn-success btn-default'))}}
		{{Form::close()}}
	</div>
@stop