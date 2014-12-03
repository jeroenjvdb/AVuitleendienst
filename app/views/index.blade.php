<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
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
</body>
</html>