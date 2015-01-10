@extends("global.base")

@section("page-title")
	Succes
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	
	@if($enddate)
		<h2>Item succesvol uitgecheckt. </h2>
		<p>Uw item werd succesvol uitgecheckt. Ten laatste terug inchecken voor {{$enddate}}</p>
	@else
		<h2>Item succesvol ingecheckt. </h2>
		<p>Uw item werd succesvol ingecheckt.</p>
	@endif
	{{Form::open(['url' => '/opmerking', "class" => "form-horizontal"])}}
	<h3>Eventuele opmerking: (toestand van het toestel,...)</h3>
	<div>
		{{Form::label('title','Titel: ')}}
		{{Form::text('title','',array("class" => "form-control"))}}
	</div>
	<div>
		{{Form::label('message','Opmerking: ')}}
		{{Form::textarea('message','',array("class" => "form-control"))}}
	</div><br>
	{{Form::hidden("materialid", $matid)}}
	{{Form::submit('Verzenden', ["class" => "btn btnreg btn-success btn-default"])}}
	{{Form::close()}}
@stop