@extends("global.base")

@section("page-title")
	Inchecken
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Materiaal Inchecken</h1>
	</div>
	{{Form::open(['url' => 'incheckenMateriaal', "class" => "check"])}}
		<div>
			{{Form::label('barcode','Barcode van het toestel: ')}}
			{{Form::text('barcode','',array('required' => "required", "class" => "form-control"))}}
			
			{{Form::submit('Inchecken', ["class" => "btn btnDefault"])}}
		</div>
	{{Form::close()}}
@stop


