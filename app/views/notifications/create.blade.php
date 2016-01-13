@extends('global.base')

@section('page-title')
	Notification toevoegen
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
	<h1>Notificatie toevoegen</h1>
	{{ Form::open(array('route' => 'notifications.create', 'method' => 'post')) }}
	<div class="form-group">
		{{ Form::label('message', 'Bericht') }}</br>
		{{ Form::textarea('message', '',array('class'=>'form-control')) }}</br>
	</div>
	<div class="checkbox">
		<h4>Belangrijke notificaties komen steeds bovenaan</h4>
		<label for="important">
			{{ Form::checkbox('important','important',false) }} Belangrijk
		</label>
	</div>
	
    <div class="form-group">
    	<h3>Zichtbaarheids periode</h3>
        <div class="row">
            <div class="col-md-6">
            	<h4>Start</h4>
                <div id="datetimepickerStart"></div>
            </div>
            <div class="col-md-6">
            	<h4>Stop</h4>
                <div id="datetimepickerStop"></div>
            </div>
        </div>
    </div>
	{{Form::hidden('dateStart',date('Y-m-d H:i'))}}
	{{Form::hidden('dateStop',date('Y-m-d H:i'))}}

	{{ Form::submit('Notificatie toevoegen',array('class' => 'btn btnDefault')) }}

	{{ Form::close() }}
@stop
@section('scripts')
<script type="text/javascript">
$('#datetimepickerStart').datetimepicker({
    inline: true,
    locale: 'nl',
    sideBySide: true,
    defaultDate: moment().format(),
});

$('#datetimepickerStop').datetimepicker({
    inline: true,
    locale: 'nl',
    sideBySide: true,
    defaultDate: moment().format(),
    minDate: moment().format(),
    useCurrent: false
});

$('#datetimepickerStart').on("dp.change", function (e) {
    $('#datetimepickerStop').data("DateTimePicker").minDate(e.date);
    $('#datetimepickerStop').data("DateTimePicker").date(e.date);
    $( "input[name='dateStart']").val(e.date.format("YYYY-MM-DD HH:mm"));
});
$('#datetimepickerStop').on("dp.change", function (e) {
    $( "input[name='dateStop']").val(e.date.format("YYYY-MM-DD HH:mm"));
});

</script>
@stop