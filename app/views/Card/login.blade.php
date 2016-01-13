@extends('global.base')

@section("page-title")
	login via studentenkaart
@stop

@section("nav")
	{{-- @include("global.nav") --}}
@stop

@section("content")
	<div class="title">
		<h1>scan je studentenkaart</h1>
	</div>
	{{Form::open(['route' => 'cardLogin', "class" => "check"])}}
		<div>
			{{Form::label('barcode','Barcode van uw studentenkaart: ')}}
			{{Form::text('barcode','',array('required' => "required", "class" => "form-control"))}}
			
			{{Form::submit('login', ["class" => "btn btnDefault"])}}
		</div>
	{{Form::close()}}
	<a href="{{ route('login') }}">login via studentenaccount</a>
@stop