@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	<h1>{{{$material->name}}}
		@if($material->status == "missing")
			<small class="infoorange">{{$material->status}}
		@elseif($material->status == "broken")
			<small class="infored">{{$material->status}}
		@endif
		</small>
	</h1>
	<div>
		@if(Session::has('message') )
			{{Session::get('message')}}
		@endif		
	</div>

	<div class="row">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<img src="/images/{{$material->image}}" alt="{{$material->name}}" class="detailimg">
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<p>{{{$material->details}}}</p>
			</div>
		</div>
		
		<h2 class="indexacctitle">Accessoires</h2>
		<div class="row">
		@forelse($material->accessories as $accessorie)
			@if($accessorie->status == 'ok')
			<div class="col-sm-6 col-md-4 col-xs-12">
				<div class="thumbnail loginbox loginboxinner loginboxshadow">
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

		<h2 class="indexacctitle">Andere suggesties</h2>
		<div class="row">
			@foreach($material->categories as $categorie)
				@forelse($categorie->materials as $catMaterial)
					@if(($material->id != $catMaterial->id) && ($catMaterial->status =='ok'))
					<div class="col-sm-6 col-md-4 col-xs-12">
						<div class="thumbnail loginbox loginboxinner loginboxshadow">
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

		{{-- <div class="detailcalendar">
			<a name="calendar"></a>
			{{$cal->generate($material->id)}}
		</div> --}}
		<div id="scheduler_here" class="dhx_cal_container" style='width:100%px; height:700px; padding:10px;'>
		    <div class="dhx_cal_navline">
		        <div class="dhx_cal_prev_button">&nbsp;</div>
		        <div class="dhx_cal_next_button">&nbsp;</div>
		        <div class="dhx_cal_today_button"></div>
		        <div class="dhx_cal_date"></div>
		        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
		        <div class="dhx_cal_tab" name="week_tab" style="right:76px;"></div>
		    </div>
		    <div class="dhx_cal_header"></div>
		    <div class="dhx_cal_data"></div>       
		</div>
		
	</div>
@stop

@section('styles')
	<link rel="stylesheet" href="/calendar/dhtmlxscheduler.css" type="text/css">
	<link rel="stylesheet" href="/calendar/extra-calendar.css" type="text/css">
@stop

@section('scripts')
	<script src="/calendar/dhtmlxscheduler.js" type="text/javascript"></script>
	<script src="/calendar/ext/dhtmlxscheduler_limit.js" type="text/javascript"></script>
	<script src="/calendar/ext/dhtmlxscheduler_all_timed.js" type="text/javascript"></script>
	<script src="/calendar/locale/locale_nl.js"  type="text/javascript"></script>
	<script src="/calendar/locale/recurring/locale_recurring_nl.js"  type="text/javascript"></script>
	<script>
	scheduler.config.xml_date = "%Y-%m-%d %h:%i";

	//highlight past time each time view changes
	var block_id = null;
	scheduler.attachEvent("onBeforeViewChange", function(old_mode,old_date,mode,date){
	    if(block_id) 
	      scheduler.deleteMarkedTimespan(block_id);
	        
	  	var from = scheduler.date[mode + "_start"](new Date(date));
	  	var to = new Date(Math.min(+new Date(), +scheduler.date.add(from, 1, mode)));
	  
	    block_id = scheduler.addMarkedTimespan({
	      start_date: from, 
	      end_date:to, 
	      type:"dhx_time_block"
	    });
	      
	    return true;
	});

	// set allowed time - from the current date, and update each minute
	scheduler.config.limit_start = new Date();
	scheduler.config.limit_end = new Date(9999, 1,1);
	setInterval(function(){
	   scheduler.config.limit_start = new Date();
	}, 1000*60);

	scheduler.config.first_hour = 8;
	scheduler.config.last_hour = 22;
	scheduler.attachEvent("onEmptyClick", function (date, e){
		var myDate = new Date(date);
		if(myDate > new Date())
		{
			var stringDate = myDate.getFullYear();
			var stringHour = "";
			var month = myDate.getMonth();
			var day = String(myDate.getDate());
			var hours = String(myDate.getHours());
			var seconds = String(myDate.getSeconds());

			month += 1;
			month = String(month);
			console.log(day.length);

			//Round minutes to 0 or 30
			if(myDate.getMinutes() < 30)
			{
				myDate.setMinutes(0);
			}
			else
			{
				myDate.setMinutes(30);

			}
			var minutes = String(myDate.getMinutes());

			//Make sure date numbers are always with leading 0 if needed			
			if(month.length == 1)
			{
				stringDate += '-0'+month;
			}
			else
			{
				stringDate += '-'+month;
			}

			if(day.length == 1)
			{
				stringDate += '-0'+day;
			}
			else
			{
				stringDate += '-'+day;
			}


			if(hours.length == 1)
			{
				stringHour += '0'+hours;
			}
			else
			{
				stringHour += hours;
			}

			if(minutes.length == 1)
			{
				stringHour += ':0'+minutes;
			}
			else
			{
				stringHour += ':'+minutes;
			}

			if(seconds.length == 1)
			{
				stringHour += ':0'+seconds;
			}
			else
			{
				stringHour += ':'+seconds;
			}
			window.location.href = '/reservations/create/'+stringDate+'/'+stringHour+'/' + <?php echo $material->id?>;
		}
	});
	scheduler.config.readonly = true;

	scheduler.attachEvent("onTemplatesReady", function() {
		var highlight_step = 30; // we are going to highlight 30 minutes timespan

		var highlight_html = "";
		var hours = scheduler.config.last_hour - scheduler.config.first_hour; // e.g. 24-8=16
		var times = hours*60/highlight_step; // number of highlighted section we should add
		var height = scheduler.config.hour_size_px*(highlight_step/60);
		for (var i=0; i<times; i++) {
			highlight_html += "<div class='highlighted_timespan' style='height: "+height+"px;'></div>"
		}
		scheduler.addMarkedTimespan({
			days: "fullweek",
			zones: "fullday",
			html: highlight_html
		});
	});

	scheduler.templates.hour_scale = function(date){
            var hour = date.getHours();
            var top = '00';
            var bottom = '30';
            hour =  date.getHours();
            var html = '';
            var section_width = Math.floor(scheduler.xy.scale_width/2);
            var minute_height = Math.floor(scheduler.config.hour_size_px/2);
            html += "<div class='dhx_scale_hour_main' style='width: "+section_width+"px; height:"+(minute_height*2)+"px;'>"+hour+"</div><div class='dhx_scale_hour_minute_cont' style='width: "+section_width+"px;'>";
            html += "<div class='dhx_scale_hour_minute_top' style='height:"+minute_height+"px; line-height:"+minute_height+"px;'>"+top+"</div><div class='dhx_scale_hour_minute_bottom' style='height:"+minute_height+"px; line-height:"+minute_height+"px;'>"+bottom+"</div>";
            html += "<div class='dhx_scale_hour_sep'></div></div>";
            return html;		
		};

	scheduler.config.hour_date = "%H:%i";
	scheduler.config.multi_day = true;
	scheduler.config.all_timed = true;
	scheduler.init("scheduler_here",new Date(),"week");

	var reservations = "[";
</script>

@foreach($resJson as $reservation)
<script>
	reservations += '{id:"<?php echo $reservation->id?>", start_date:"<?php echo $reservation->begin ?>", \
	end_date:"<?php echo $reservation->end ?>", \
	text:"<?php echo $reservation->users->first()->firstname.' '.$reservation->users->first()->lastname ?>"},';
</script>
@endforeach
<script>
	reservations += "]";
	console.log(reservations);
	//var obj = JSON.parse(reservations);
	scheduler.parse(reservations,"json");
</script>
@stop