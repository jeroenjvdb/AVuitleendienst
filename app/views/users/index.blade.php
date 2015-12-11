@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<!--<h1>Welkom, {{Auth::user()->firstname}}</h1>-->
		<h1>Reserveren</h1>
	</div>
	<div class="col-md-6 col-md-offset-3 text-center">

		<h2>Categoriën</h2>
		<div class="form-group">
			<select class="form-control text-center" id="categorySelect">
			@forelse($categories as $categorie)
					<option class="text-center" value="{{$categorie->id}}">{{{ucfirst($categorie->name)}}}</option>
				@empty
					<option value="0"></option>
			@endforelse
			</select>
		</div>
	</div>
	<div class="col-md-12">
	@forelse($categories as $categorie)
		<div class="category" id="category{{$categorie->id}}">
			<h3 class="subTitle text-center">{{{ucfirst($categorie->name)}}}</h3>
			<div class="categoryfull span4Container">
				<div class="col-md-12">
					<div id="calendar{{$categorie->id}}"></div>
				</div>
			</div>
		</div>
	@empty
		<div class="nocategory">
			<p>Oeps looks there is a problem please contact webmaster and let him do some more magic.</p>
		</div>
	@endforelse	
	</div>	
@stop

@section('scripts')
	<script> 
		var reservations = [];
	</script>
	@foreach($categories as $categorie)
		@foreach($categorie->materials as $material)
			@foreach($material->reservations as $reservation)
				<script>
				reservations.push(<?php echo $reservation->toJson() ?>);
				</script>
			@endforeach
		@endforeach

		<script>
			// $('.fc-today').prevAll('td').css('backgroundColor','yellow');
			// var now = moment().format('DD-MM-YYYY HH:mm');
			// var past = {
			// 	start : "0000-00-00 00:00",
			// 	end : now,
			// 	rendering: "background" 
			// };
			// reservations.push(past);
			$('#calendar<?php echo $categorie->id ?>').fullCalendar({
			    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			     views: {
			        timelineFourDays: {
			            type: 'timeline',
			            duration: { days: 4 }
			        }
			    },
			    defaultView: 'timelineWeek',
			    eventOverlap:false,
			    slotDuration: {hours:4},
			    slotLabelInterval: {hours:4},
			    minTime: "08:00",
			    maxTime: "20:00",
			    resourceLabelText: "<?php echo ucfirst($categorie->name)?>",
			    resourceAreaWidth: "10%",
			    eventResourceField: "material",
			    slotLabelFormat: ['dddd - D/M','HH:mm'],
			    resources: <?php echo $categorie->materials->toJson() ?>,
			    events: reservations,
			    viewRender: function(currentView){
						var minDate = moment();
						// Past
						if (minDate >= currentView.start && minDate <= currentView.end) {
							$(".fc-prev-button").prop('disabled', true); 
							$(".fc-prev-button").addClass('fc-state-disabled'); 
						}
						else {
							$(".fc-prev-button").removeClass('fc-state-disabled'); 
							$(".fc-prev-button").prop('disabled', false); 
						}
			   },
			    dayClick: function(date, jsEvent, view, resourceObj) {
			        var minDate = moment().add(4, 'hours');
			
					if (minDate  < date) {
						alert('Clicked on: ' + date.format());
					}
					else {
						alert('nee');
					}
			    }
			});
		</script>
	@endforeach
	<script>
		console.log(reservations);
	</script>
@stop
