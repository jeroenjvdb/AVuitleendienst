@extends("global.base")

@section("page-title")
	Succes
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Item succesvol uitgecheckt. </h1>
	@if($enddate)
		<p>Uw item werd succesvol uitgecheckt. Ten laatste terug inchecken voor {{$enddate}}</p>
	@else
		<p>Uw item werd succesvol ingecheckt.</p>
	@endif
	{{Form::open(['url' => '/opmerking', "class" => "form-horizontal"])}}
	<h2>Eventuele opmerking: (toestand van het toestel,...)</h2>
	<div class="form-group">
		{{Form::label('title','Titel opmerking', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label"])}}
		<div class="col-sm-8">
			{{Form::text('title','',array("class" => "form-control border", "rows" => "2"))}}
		</div>		
	</div>
	<div class="form-group">
		{{Form::label('message','Eventuele opmerking: ', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label"])}}
		<div class="col-sm-8">
			{{Form::textarea('message','',array("class" => "form-control border", "rows" => "2"))}}
		</div>		
	</div>
	{{Form::hidden("materialid", $matid)}}
	<div class="loginbox confirm">
		{{Form::submit('Verzenden', ["class" => "btn btnreg btn-success"])}}
	</div>	
	{{Form::close()}}
@stop