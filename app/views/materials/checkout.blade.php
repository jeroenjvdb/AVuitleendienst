@extends("global.base")

@section("page-title")
	Uitchecken
@stop

@section("nav")
	@include("Card.nav")
@stop

@section("content")
	<div class="title">
		<h1>Materiaal Uitchecken</h1>
	</div>
	{{Form::open(['url' => 'uitcheckenMateriaal', "class" => "check"])}}
		<div>
			{{Form::label('barcode','Barcode van het toestel: ')}}
			{{Form::text('barcode','',array('id' => 'focus', 'required' => "required", "class" => "form-control"))}}
			
			{{Form::submit('Uitchecken', ["class" => "btn btnDefault"])}}
		</div>
	{{Form::close()}}

	@section('scripts')
		<script type="text/javascript">
			window.onload = function FocusOnInput() 
			{
				document.getElementById("focus").focus();
			}
		</script>
	@stop
@stop


