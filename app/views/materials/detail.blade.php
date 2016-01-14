@extends("global.base")

@section("page-title")
	Materiaal Beheer: {{ucfirst($material->name)}}
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	<div class="title">
		<h1>Details {{ucfirst($material->name)}}
			@if($material->status == "missing")
				<small class="infoorange">{{$material->status}}
			@elseif($material->status == "broken")
				<small class="infored">{{$material->status}}
			@endif
			</small>
		</h1>
	</div>
	<div>
		@if(Session::has('message') )
			{{Session::get('message')}}
		@endif		
	</div>

	<div class="row details">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 image">
			<img src="/images/{{$material->image}}" alt="{{$material->name}}" class="detailimg">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 info">
			<p>{{{$material->details}}}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h2>Reservatie Kalender</h2>
			<div id="calendar" class="fullCalendar"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2 class="subTitle">Accessoires</h2>
			<div class="span4Container">
				@forelse($material->accessories as $accessorie)
					@if($accessorie->status == 'ok')
					<div class="col-sm-6 col-md-4 col-xs-12 span4">
						<div class="thumbnail tnExtra">
							<a href="{{$app['url']->to('/')}}/materials/{{$accessorie->id}}" class="item">
								<h3>{{{$accessorie->name}}}</h3>
								<img src="/images/{{$accessorie->image}}" alt="">
								<div class="caption">
									<p>{{{$accessorie->details}}}</p>
								</div>
							</a>
						</div>
					</div>
					@endif
				@empty
					<h4 class="notification">Geen accessoires voor dit item.</h4>
				@endforelse
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2 class="subTitle">Andere suggesties</h2>
			<div class="span4Container">
				@foreach($material->categories as $categorie)
					@forelse($categorie->materials as $catMaterial)
						@if(($material->id != $catMaterial->id) && ($catMaterial->status =='ok'))
						<div class="col-sm-6 col-md-4 col-xs-12 span4">
							<div class="thumbnail tnExtra">
								<a href="{{$app['url']->to('/')}}/materials/{{$catMaterial->id}}" class="item">
									<h3> {{{$catMaterial->name}}}</h3>
									<img src="/images/{{$catMaterial->image}}" alt="">
									<div class="caption">
										<p>{{{$catMaterial->details}}}</p>
									</div>
								</a>
							</div>
						</div>
						@endif
					@empty
					<h4 class="notification">Geen gerelateerde items gevonden.</h4>
					@endforelse
				@endforeach
			</div>
		</div>
	</div>
@stop

@section('styles')
	<link rel="stylesheet" href="/calendar/dhtmlxscheduler.css" type="text/css">
	<link rel="stylesheet" href="/calendar/extra-calendar.css" type="text/css">
@stop

@section('scripts')

<script>
	var reservations = <?php echo $reservations->toJson() ?>;
	var resources = [];
	resources.push(<?php echo $material->toJson() ?>);

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

		for (var u = 0; u < reservations[i].users.length; u++)
		{
			if(reservations[i].users[u].type == "admin" || reservations[i].users[u].type == "monitor")
			{
				reservations[i].backgroundColor = "#FA5D5D";
				reservations[i].borderColor = "#FA5D5D";
				reservations[i].textColor = "#ffffff";
			}
			else if(reservations[i].users[u].type == "teacher")
			{
				reservations[i].backgroundColor = "#B371A1";
				reservations[i].borderColor = "#B371A1";
				reservations[i].textColor = "#ffffff";
			}
			else if(reservations[i].users[u].type == "student")
			{
				reservations[i].backgroundColor = "#6989C1";
				reservations[i].borderColor = "#6989C1";
				reservations[i].textColor = "#ffffff";
			}
		}
	};
	$('#calendar').fullCalendar({
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
	    selectable:false,
	    unselectAuto: false,
	    selectOverlap: false,
	    height:"auto",
	    resourceLabelText: "<?php echo ucfirst($material->name)?>",
	    resourceAreaWidth: "15%",
	    eventResourceField: "material",
	    slotLabelFormat: ['dddd - D/M','HH:mm'],
	    resources: resources,
	    events: reservations,
	    resourceText: function(resource)
	    {
	    	var text = resource.title.charAt(0).toUpperCase() + resource.title.slice(1);
	    	return text
	    },
	    viewRender: function(currentView){
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
	   }
	});
</script>
@stop