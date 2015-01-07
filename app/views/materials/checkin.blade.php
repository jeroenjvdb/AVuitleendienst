@extends("global.base")

@section("page-title")
	Incheck
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Materiaal Inchecken</h1>

	{{Form::open(['url' => 'incheckenMateriaal', "class" => "form-horizontal"])}}

	<div class="form-group">
		{{Form::label('barcode','Barcode van het toestel: ', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label"])}}
		<div class="col-sm-8">
			{{Form::text('barcode','',array('required' => "required", "class" => "form-control border", "rows" => "2"))}}
		</div>		
	</div>

	<div class="loginbox confirm">
		{{Form::submit('Inchecken', ["class" => "btn btnreg btn-success"])}}
	</div>
	
	{{Form::close()}}
@stop