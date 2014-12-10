@extends("global.base")

@section("page-title")
	Welkom
@stop

@section("content")
<div id="wrapper">
    <div id="login" class="animate form">
    	{{Form::open(['route' => 'sessions.store'])}}
        <h1>Inloggen</h1> 
		@if(Session::has('err'))
			<div>{{ Session::get('err') }}</div>
	    @endif
        <p>
			{{Form::email('email','', array('placeholder' => 'Email','required' => 'required'))}}
        </p>
        <p>
			{{ Form::password('password', ['placeholder' => 'Paswoord','type' => 'password','required','min' => '8']) }}                
        </p>
        <p class="login button"> 
        	{{ Form::submit('Log in', ['class' => 'inloggen','value' => 'LOGIN'])}}
		</p>
    	{{ Form::close() }}               
	</div>
</div>
@stop