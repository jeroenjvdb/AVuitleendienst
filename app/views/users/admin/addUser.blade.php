@extends("global.base")

@section("page-title")
	Nieuwe gebruiker
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Gebruiker Toevoegen</h1>
	</div>
	<div>
		{{Form::open(['route' => 'users.store'])}}
		<div>
			{{Form::label('naam','Email:')}}<br>
			{{Form::text('email', null, array('required' => 'required','class' => 'form-control'))}}
			{{$errors->first("email", "<span>:message</span>")}}			
		</div>
		<div>
		<br>
			{{Form::label('naam','Wachtwoord:')}}<br>
			{{Form::password('password', array('required' => 'required','class' => 'form-control'))}}
			{{$errors->first("password", "<span>:message</span>")}}			
		</div>
		<div>
		<br>
			{{Form::label('naam','Voornaam:')}}<br>
			{{Form::text('firstname', null, array('required' => 'required','class' => 'form-control'))}}
			{{$errors->first("firstname", "<span>:message</span>")}}		
		</div>
		<div>
		<br>
			{{Form::label('naam','Achternaam:')}}<br>
			{{Form::text('lastname', null, array('required' => 'required','class' => 'form-control'))}}
			{{$errors->first("lastname", "<span>:message</span>")}}		
		</div>
		<div>
		<br>
			{{Form::label('naam','Type:')}}<br>
			{{Form::select('type', ["teacher" => "Leerkracht", "monitor" => "Monitor", "student" => "Student"],'',array('class' => 'form-control'))}}
			{{$errors->first("type", "<span>:message</span>")}}		
		</div>
		<br>
		{{Form::submit('Toevoegen',array('class' => 'btn btnreg btn-success btn-default'))}}
		{{Form::close()}}
	</div>
@stop