@extends('global.base')

@section('page-title')
	notification toevoegen
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
<h1>notification toevoegen</h1>
	{{ Form::open(array('route' => 'notifications.create', 'method' => 'post')) }}
		{{ Form::label('message', 'bericht') }}</br>
		{{ Form::textarea('message', '') }}</br>
		{{ Form::checkbox('important') }}
		{{ Form::label('important', 'important') }}</br>

		<h5>show:</h5>
		{{ Form::label('from', 'van') }}</br>
		{{ Form::input('date', 'from') }} {{ Form::selectRange('fromHour', 0, 23) }} {{ Form::selectRange('fromMinute', 0, 59) }} </br>
		{{ Form::label('until', 'tot') }}</br>
		{{ Form::input('date', 'until') }} {{ Form::selectRange('untilHour', 0, 23) }} {{ Form::selectRange('untilMinute', 0, 59) }} </br>


		{{ Form::submit('Notificatie toevoegen',array('class' => 'btn btnDefault')) }}

	{{ Form::close() }}
@stop