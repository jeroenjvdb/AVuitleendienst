@extends("global.base")

@section("page-title")
	Welkom
@stop

@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="loginbox loginboxinner loginboxshadow">
            {{Form::open(['route' => 'sessions.store'])}}
                <legend>Inloggen</legend>
                @if(Session::has('err'))
                    <div>{{ Session::get('err') }}</div>
                @endif                
                <div class="form-group">
                    <label for="username-email">E-mail</label>                
                    {{Form::email('email','', array('placeholder' => 'Je e-mail','required' => 'required','id' => 'username-email','class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    <label for="password">Paswoord</label>                
                    {{ Form::password('password', ['placeholder' => 'Je paswoord','type' => 'password','required','min' => '8','id' => 'password','class' => 'form-control']) }}                
                </div>
                <div class="form-group text-center centerbuttons">                        
                    <input type="submit" class="btn btn-success btn-login-submit" value="Login" />
                    <button type="submit" class="btn btnreg btn-success btn-default">Registreer</button>
                </div>
            {{ Form::close() }}               
        </div>
    </div>
</div>

@stop