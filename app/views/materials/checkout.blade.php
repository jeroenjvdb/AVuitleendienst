@extends("global.base")

@section("page-title")
	Uitchecken
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Materiaal Uitchecken</h2>
	{{Form::open(['url' => 'uitcheckenMateriaal'])}}
		<div>
		{{Form::label('barcode','Barcode van het toestel: ')}}
		{{Form::text('barcode','',array('required' => "required", "class" => "form-control"))}}
		</div><br>
		{{Form::submit('Uitchecken', ["class" => "btn btnreg btn-success btn-default"])}}
	{{Form::close()}}
@stop


