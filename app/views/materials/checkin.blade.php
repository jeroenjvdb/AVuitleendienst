@extends("global.base")

@section("page-title")
	Inchecken
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h2>Materiaal Inchecken</h2>
	<div>
	{{Form::open(['url' => 'incheckenMateriaal'])}}
		<div>
		{{Form::label('barcode','Barcode van het toestel: ')}}
		{{Form::text('barcode','',array('required' => "required", "class" => "form-control"))}}
		</div><br>
		{{Form::submit('Inchecken', ["class" => "btn btnreg btn-success btn-default"])}}
	{{Form::close()}}
	</div>
@stop


