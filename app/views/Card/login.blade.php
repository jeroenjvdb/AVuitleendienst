@extends('global.base')

@section("page-title")
	Card Login
@stop

@section("nav")
	{{-- @include("global.nav") --}}
@stop

@section("content")
	<div class="title">
		<h1>scan je studentenkaart</h1>
	</div>
	{{Form::open(['route' => 'cardLogin', "class" => "check","id" => "scanForm"])}}
		<div>
			{{Form::label('barcode','Barcode van uw studentenkaart: ')}}
			{{Form::text('barcode','',array('required' => "required", "class" => "form-control","id" => "scanBar"))}}
			
			{{Form::submit('login', ["class" => "btn btnDefault","id" => "submit"])}}
		</div>
	{{Form::close()}}
	<a href="{{ route('login') }}">login via studentenaccount</a>
@stop

@section('scripts')
<script>
	$('#scanBar').on('input',function(){
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
		$(this).val(barcode);
		console.log($(this).val().length);
		if($(this).val().length == 10)
		{
			console.log('test');
			$("#submit").trigger('click');
		}
	});

	
</script>
@stop