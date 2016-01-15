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
			$('#focus').on('input',function(){
				var barcode = $(this).val();
				for(var i=0; i < barcode.length; i++)
				{
					barcode = barcode.replace("°","");
					barcode = barcode.replace("&","1");
					barcode = barcode.replace("é","2");
					barcode = barcode.replace('"',"3");
					barcode = barcode.replace("'","4");
					barcode = barcode.replace("(","5");
					barcode = barcode.replace("§","6");
					barcode = barcode.replace("è","7");
					barcode = barcode.replace("!","8");
					barcode = barcode.replace("ç","9");
					barcode = barcode.replace("à","0");
				}
			});
		</script>
	@stop
@stop


