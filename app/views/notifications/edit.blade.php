@extends('global.base')

@section('page-title')
	Notification aanpassen
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
	<h1>Notificatie aanpassen</h1>
	{{Form::model($notification, array('route' => array('notifications.update', $notification->id)))}}
	<div class="form-group">
		{{ Form::label('message', 'Bericht') }}</br>
		{{ Form::textarea('message', $notification->message,array('class'=>'form-control')) }}</br>
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
	{{Form::hidden('dateStart',$notification->show_from)}}
	{{Form::hidden('dateStop',$notification->show_until)}}

	{{ Form::submit('Notificatie aanpassen',array('class' => 'btn btnDefault')) }}

	{{ Form::close() }}
@stop
@section('scripts')
<script type="text/javascript">
var start = '<?php echo $notification->show_from ?>';
var stop = '<?php echo $notification->show_until ?>';
$('#datetimepickerStart').datetimepicker({
    inline: true,
    locale: 'nl',
    sideBySide: true,
    defaultDate: start
});

$('#datetimepickerStop').datetimepicker({
    inline: true,
    locale: 'nl',
    sideBySide: true,
    defaultDate: stop,
    minDate: start,
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