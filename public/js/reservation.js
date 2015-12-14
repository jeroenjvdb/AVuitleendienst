$(document).ready(function(){
	$('.calendar').fullCalendar({
	    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
	    defaultView: 'timelineWeek',
	    slotDuration: "04:00",
	    slotLabelInterval: "04:00",
	    minTime: "08:00",
	    maxTime: "22:00",
	    slotLabelFormat: ['dddd - D/M','HH:mm'],
	});
});