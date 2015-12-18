@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop
@section('styles')
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
@stop
@section("content")
<div class="reserveren">

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
	<!-- Reservation Modal -------------------------------------------------------------------------- -->
	<div class="modal fade" id="reservationModal" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="gridSystemModalLabel">Reservatie bevestigen</h4>
	      </div>
	      <form id="formReservation">
	      <div class="modal-body">
	        <div class="row">
	          <div class="col-md-12">
          		<div class="form-group">
	          		<label for="start">Materiaal:</label>
	          		<p class="form-control-static" id="reservationItem"></p>
	          	</div>
	          	<div class="form-group">
	          		<label for="start">Begin:</label>
	          		<p class="form-control-static" id="reservationStart"></p>
	          	</div>
				<div class="form-group">
	          		<label for="start">Einde:</label>
	          		<p class="form-control-static" id="reservationStop"></p>
	          	</div>
          		<div class="form-group">
      				<label for="reason">Reden van reservatie:</label>
          			<textarea id="reason" class="form-control" rows="3" required></textarea>
          		</div>
          		<div class="form-group">
          			<label for="reason">Mede gebruikers:</label>
      				<select name="users[]" id="users" class="label-selector form-control" multiple="multiple" style="width:100%">
	                    @foreach($users as $user)
	                        <option value="{{$user->id}}">{{$user->firstname.' '.$user->lastname}}</option>
	                    @endforeach
	                </select>
          		</div>
          		<div class="form-group">
          			<label for="reason">Koppel reservatie:</label>
          			<p>Kies hieronder items die je tegelijkertijd wil reserveren</p>
      				<select name="accessoiries[]" id="accessoiries" class="label-selector form-control" multiple="multiple" style="width:100%">
	                    
	                </select>
          		</div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Sluiten</button>
	        <button type="submit" class="btn btn-primary">Reserveren</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- End Reservation Modal -------------------------------------------------------------------------- -->

	<div class="col-md-12">
		<h3>Jouw Reservatie:</h3>
	</div>
	<div class="col-md-12">
		<div  class="col-xs-3 text-center">
			<h4><strong>Materiaal</strong></h4>
		</div>
		<div  class="col-xs-3 text-center">
			<h4><strong>Start</strong></h4>
		</div>
		<div class="col-xs-3 text-center">
			<h4><strong>Stop</strong></h4>
		</div>
		<div class="col-xs-3 text-center">
			<h4><strong>Actie</strong></h4>
		</div>
	</div>
	<div class="col-md-12">
		<div id="resource" class="col-xs-3 text-center">
			<h4>-</h4>
		</div>
		<div id="start" class="col-xs-3 text-center">
			<h4>-</h4>
		</div>
		<div id="stop" class="col-xs-3 text-center">
			<h4>-</h4>
		</div>
		<div class="col-xs-3 text-center">
			<button class="btn btn-danger btn-sm remove hide" onclick="clearReservaton()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			<button class="btn btn-primary btn-sm confirm hide" onclick="openReservaton()"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
		</div>
	</div>
	<div class="col-md-12">
	@forelse($categories as $categorie)
		<div class="category" id="category{{$categorie->id}}">
			<h3 class="subTitle text-center">{{{ucfirst($categorie->name)}}}</h3>
			<div class="categoryfull span4Container">
				<div class="col-md-12">
					<div id="calendar{{$categorie->id}}" class="fullCalendar"></div>
				</div>
			</div>
		</div>
	@empty
		<div class="nocategory">
			<p>Oeps looks there is a problem please contact webmaster and let him do some more magic.</p>
		</div>
	@endforelse	
	</div>

</div>	
@stop

@section('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script> 
		$(".label-selector").select2();

		var reservations = [];
		var accessoiries = [];
		var rawStart = null;
		var rawStop = null;
		var reservationStart = null;
		var reservationStop = null;
		var reservationResource = null;

		var populateAccessoiries = function(){
			$('.accessoirie').remove();
			for (var i =  0; i < accessoiries.length; i++) {
				$('#accessoiries').append(accessoiries[i]);
			};
		}
		var clearReservaton = function(){
			reservationStart = null;
			reservationStop = null;
			reservationResource = null;
			rawStart = null;
			rawStop = null;

			$('#resource h4').html('-');
			$('#start h4').html('-');
			$('#stop h4').html('-');

			$('.fullCalendar').fullCalendar('unselect');
			$('.remove').addClass('hide');
			$('.confirm').addClass('hide');
		}

		var openReservaton = function(){
			populateAccessoiries();
			//Convert to correct time
			if(reservationStart.format("H") == 0)
			{
				reservationStart.add(8,'hours');
			}
			else if(reservationStart.format("H") == 12)
			{
				reservationStart.add(2,'hours');
			}

			if(reservationStop.format("H") == 0)
			{
				reservationStop.subtract(4,'hours');
			}
			else if(reservationStop.format("H") == 12)
			{
				reservationStop.add(2,'hours');
			}
			$('#accessoirie'+reservationResource.id).remove();
			$('#reservationItem').html(reservationResource.title.cFirst());
			$('#reservationStart').html(reservationStart.format("dddd, Do MMMM YYYY, H:mm"));
			$('#reservationStop').html(reservationStop.format("dddd, Do MMMM YYYY, H:mm"));
			$('#reservationModal').modal('show');
		}
		$('#formReservation').on('submit',function(e){
			e.preventDefault();
			var start = reservationStart;
			var stop = reservationStop;
			var material_id = reservationResource.id;
			var reason = $('#reason').val();
			var users = $('#users').val();
			var chainReservations = $('#accessoiries').val();

	 		console.log(start.format());
	 		console.log(stop.format());
		 	$.ajax({
                type: "POST",
                url : "/reservation/create",
                data : {
                	start: start.format(),
                	stop: stop.format(),
                	material_id: material_id,
                	reason: reason,
                	user: "<?php echo Auth::user()->id ?>",
                	users: users,
                	chainReservations: chainReservations
                },
                success : function(data){
                  	$('#reservationModal').modal('hide');
               
                  	//Place reservations on calendar
                  	var events = [];
              		for (var i = 0; i < data.reservations.length; i++) {
                  		var start = moment(data.reservations[i].start);
						var end = moment(data.reservations[i].end);
						
						//Convert start & stop to fit calendar
						if(start.format("H") == 8)
						{
							data.reservations[i].start = start.subtract(8,'hours');
						}
						else if(start.format("H") == 14)
						{
							data.reservations[i].start = start.subtract(2,'hours');
						}

						if(end.format("H") == 14)
						{
							data.reservations[i].end = end.subtract(2,'hours');
						}
						else if(end.format("H") == 20)
						{
							data.reservations[i].end = end.add(4,'hours');
						}

                  		var newEvent = {
                  			id: data.reservations[i].id,
	                  		title: data.reservations[i].title,
	                  		start: data.reservations[i].start.format(),
	                  		end: data.reservations[i].end.format(),
	                  		material: data.reservations[i].material,
	                  		reason: data.reservations[i].reason,
	                  		users: data.reservations[i].users
	                  	};
                  		events.push(newEvent);
                  	};

              		//Show success message
                  	BootstrapDialog.show({
		                type:  BootstrapDialog.TYPE_SUCCESS,
		                title: 'Reservatie geslaagd',
		                message: data.message,
		                buttons: [{
		                    label: 'Sluiten',
			                action: function(dialogItself){
			                    dialogItself.close();
			                }
		                }],
		                onhide: function(dialogRef){
			                //Reload page to display new events
			                location.reload();
			            },
	            	});

                },
                error : function(jqXHR,textStatus,errorThrown ){
                	var message = "<p>"+jqXHR.responseJSON.errorMessage+"</p>"
                	if(qXHR.responseJSON.errors)
                	{
                		message += "<ul>"
                		for (var i = 0; i < jqXHR.responseJSON.errors.length;i++) {
                			message += "<li>" + qXHR.responseJSON.errors[i] + "</li>"
                		};
                		message += "</ul>"
                	}
                	//Show success message
                  	BootstrapDialog.show({
		                type:  BootstrapDialog.TYPE_DANGER,
		                title: 'Probleem met reservatie',
		                message: message,
		                buttons: [{
		                    label: 'Sluiten',
			                action: function(dialogItself){
			                    dialogItself.close();
			                }
		                }]
	            	});
                }
            },"json");
		});
		
	</script>
	@foreach($accessories as $accessoirie)
    	<script>
    	accessoiries.push('<option class="accessoirie" id="accessoirie<?php echo $accessoirie->id ?>" value="<?php echo$accessoirie->id ?>"> \
    		<?php echo ucfirst($accessoirie->name) ?> </option>');
    	</script>
	@endforeach
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
			for (var i = 0; i < reservations.length; i++)
			{
				var start = moment(reservations[i].start);
				var end = moment(reservations[i].end);
				
				//Convert start & stop to fit calendar
				if(start.format("H") == 8)
				{
					reservations[i].start = start.subtract(8,'hours');
				}
				else if(start.format("H") == 14)
				{
					reservations[i].start = start.subtract(2,'hours');
				}

				if(end.format("H") == 14)
				{
					reservations[i].end = end.subtract(2,'hours');
				}
				else if(end.format("H") == 20)
				{
					reservations[i].end = end.add(4,'hours');
				}
			};
			$('#calendar<?php echo $categorie->id ?>').fullCalendar({
			    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			     views: {
			        timelineFive: {
			            type: 'timeline',
			            duration: { days: 5 }
			        }
			    },
			    defaultView: 'timelineFive',
			    eventOverlap:false,
			    slotDuration: {hours:12},
			    slotLabelInterval: {hours:12},
			    slotWidth: 100,
			    selectable:true,
			    unselectAuto: false,
			    selectOverlap: false,
			    height:"auto",
			    resourceLabelText: "<?php echo ucfirst($categorie->name)?>",
			    resourceAreaWidth: "15%",
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

						$('.fc-cell-text').each(function(){
							if($(this).html() == "00:00")
							{
								$(this).html('Voormiddag');
							}
							else if($(this).html() == "12:00")
							{
								$(this).html('Namiddag');
							}
						});
			   },
			   eventClick: function(calEvent, jsEvent, view) {
			   		//Show modal
			   		var body = "<p><strong>Reden van reservatie: </strong></br>" + calEvent.reason + "</p></br>";
			   		if(calEvent.users)
			   		{
			   			body += "<strong>Gebruikers: </strong></br></br>";
			   			for (var i = calEvent.users.length - 1; i >= 0; i--) {
				   			body += "<a href='mailto:"+calEvent.users[i].email+"' class='btn btn-primary'><span class='glyphicon glyphicon-envelope'></span> ";
				   			body += calEvent.users[i].firstname+" "+calEvent.users[i].lastname+"</a></br></br>"
				   		};
			   		}
					BootstrapDialog.show({
		                type:  BootstrapDialog.TYPE_INFO,
		                title: 'Reservatie - '+ calEvent.title,
		                message: body,
		                buttons: [{
		                    label: 'Sluiten',
			                action: function(dialogItself){
			                    dialogItself.close();
			                }
		                }]
		            });
			    },
			    select: function( start, end, jsEvent, view, resource){
			    	var tijdStip = null;
					if(start.format("H") == 0)
					{
						tijdStip = "VM";
					}
					else
					{
						tijdStip = "NM";
					}

					var nowTijdStip = null;
					var now = moment();
					if(now.format("H") < 12)
					{
						nowTijdStip = "VM";
					}
					else
					{
						nowTijdStip = "NM";
					}
					var diff = (start.diff(end,'hours'));
					if ((diff != -12 && !(start.format("D") != now.format("D") || 
						(start.format("D") == now.format("D") && tijdStip != nowTijdStip)))) {
			    		BootstrapDialog.show({
			                type:  BootstrapDialog.TYPE_DANGER,
			                title: 'Start datum niet beschikbaar',
			                message: 'De start datum is gepasseerd of te dichtbij de huidige datum!',
			                buttons: [{
			                    label: 'Sluiten',
				                action: function(dialogItself){
				                    dialogItself.close();
				                }
			                }]
			            });
			    		$('.fullCalendar').fullCalendar('unselect');
			    		$('.confirm').addClass('hide');
			    	}
			    	else if(diff != -12)
			    	{
			    		reservationStart = start;
						reservationStop = end;

			    		if(reservationStart.format("H") == 0)
						{
							var startTijdStip = "VM";
							reservationStart = reservationStart.add(8,'hours');
						}
						else
						{
							var startTijdStip = "NM";
							reservationStart = reservationStart.add(2,'hours');
						}

						if(reservationStop.format("H") == 0)
						{
							var stopTijdStip = "NM";
							reservationStop = reservationStop.subtract(4,'hours');
						}
						else
						{
							var stopTijdStip = "VM";
							reservationStop = reservationStop.add(2,'hours');
						}

						
						reservationResource = resource;

						$('#resource h4').html(resource.title.cFirst());
						$('#start h4').html(reservationStart.format("dd D/MM - ")+ startTijdStip);
						$('#stop h4').html(reservationStop.format("dd D/MM - ")+ stopTijdStip);
						$('.confirm').removeClass('hide');
						$('.remove').removeClass('hide');
						//Show modal
						BootstrapDialog.show({
			                type:  BootstrapDialog.TYPE_SUCCESS,
			                title: 'Periode geselecteerd',
			                message: 'Je hebt de periode van je reservatie geselecteerd! </br> \
			                Bevestig je reservatie bovenaan de kalender',
			                buttons: [{
			                    label: 'Sluiten',
				                action: function(dialogItself){
				                    dialogItself.close();
				                }
			                }]
			            });
			    	}
			    },
			    dayClick: function(date, jsEvent, view, resourceObj) {
			        var tijdStip = null;
			        var cDate = date;
			        var rawDate = date;
					if(date.format("H") == 0)
					{
						tijdStip = "VM";
						cDate.add(8,'hours');
					}
					else
					{
						tijdStip = "NM";
						cDate.add(2,'hours');
					}

					var nowTijdStip = null;
					var now = moment();
					if(now.format("H") < 12)
					{
						nowTijdStip = "VM";
					}
					else
					{
						nowTijdStip = "NM";
					}
					if (date.format("D") != now.format("D") || 
						(date.format("D") == now.format("D") && tijdStip != nowTijdStip)) {

						if(reservationStart == null || 
							(reservationStart != null && reservationStop != null))
						{	
							reservationStop = null;
							$('#stop h4').html('-');
							reservationResource = null;
							$('#resource h4').html('-');


							reservationStart = cDate;
							reservationResource = resourceObj;

							$('#resource h4').html(resourceObj.title.cFirst());
							$('#start h4').html(reservationStart.format("dd D/MM - ")+ tijdStip);
							$('.confirm').addClass('hide');
							$('.remove').removeClass('hide');
							//Show modal
							BootstrapDialog.show({
				                type:  BootstrapDialog.TYPE_SUCCESS,
				                title: 'Start geselecteerd',
				                message: 'Je hebt de start van je reservatie geselecteerd! </br> \
				                Selecteer nu het einde van je reservatie',
				                buttons: [{
				                    label: 'Sluiten',
					                action: function(dialogItself){
					                    dialogItself.close();
					                }
				                }]
				            });
						}
						else if(reservationStart != null && reservationStop == null && reservationResource == resourceObj)
						{
							if(date >= reservationStart)
							{
								reservationStop = cDate;
								$('#stop h4').html(reservationStop.format("dd D/MM - ")+ tijdStip);
								$('.confirm').removeClass('hide');
								$('.remove').removeClass('hide');
								
								//Make dates fit calendar again
								var selectStart = reservationStart;
								var selectStop 	= reservationStop;

								if(selectStart.format("H") == 8)
								{
									selectStart.subtract(8,'hours');
								}
								else
								{
									selectStart.subtract(2,'hours');
								}

								if(selectStop.format("H") == 8)
								{
									selectStop.add(4,'hours');
								}
								else
								{
									selectStop.add(10,'hours');
								}
								$('#calendar<?php echo $categorie->id ?>').fullCalendar('select',selectStart,selectStop,resourceObj.id);
							}
							else
							{
								reservationStop = null;
								$('#stop h4').html('-');
								$('.confirm').addClass('hide');
								$('.remove').removeClass('hide');
								//Show modal
								BootstrapDialog.show({
					                type:  BootstrapDialog.TYPE_DANGER,
					                title: 'Ongeldige Stop Datum',
					                message: 'De stop datum kan niet voor de start datum vallen',
					                buttons: [{
					                    label: 'Sluiten',
						                action: function(dialogItself){
						                    dialogItself.close();
						                }
					                }]
					            });
							}
						}
						else if(reservationStart != null && reservationResource != resourceObj)
						{
							reservationStop = null;
							$('#stop h4').html('-');
							$('.confirm').addClass('hide');
							$('.remove').removeClass('hide');
							//Show modal
							BootstrapDialog.show({
				                type:  BootstrapDialog.TYPE_DANGER,
				                title: 'Verschillend Materiaal',
				                message: 'Je mag geen stop datum kiezen met een ander materiaal dan de \ start datum',
				                buttons: [{
				                    label: 'Sluiten',
					                action: function(dialogItself){
					                    dialogItself.close();
					                }
				                }]
				            });
						}
					}
					else {
						$('.confirm').addClass('hide');
						$('.remove').addClass('hide');
						reservationStart = null;
						reservationStop = null;
						reservationResource = null;
						rawStart = null;
						rawStop = null;
						$('#resource h4').html('-');
						$('#start h4').html('-');
						$('#stop h4').html('-');

						BootstrapDialog.show({
			                type:  BootstrapDialog.TYPE_DANGER,
			                title: 'Datum niet beschikbaar',
			                message: 'Dit tijdslot is gepasseerd of te dichtbij de huidige datum!',
			                buttons: [{
			                    label: 'Sluiten',
				                action: function(dialogItself){
				                    dialogItself.close();
				                }
			                }]
			            });
					}	
			    }
			});
		</script>
	@endforeach
@stop
