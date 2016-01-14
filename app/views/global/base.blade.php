<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield("page-title") - KdG Uitleendienst </title>
	
	{{ HTML::style("//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css") }}
	{{ HTML::style("css/bootstrap.min.css") }}
	{{ HTML::style("css/footable.core.css") }}
	{{ HTML::style('css/new.css') }}
	{{ HTML::style('pickadate/lib/compressed/themes/classic.css') }}
	{{ HTML::style('pickadate/lib/compressed/themes/classic.date.css') }}
	{{ HTML::style('pickadate/lib/compressed/themes/classic.time.css') }}
	{{ HTML::style("bower_components/fullcalendar/dist/fullcalendar.min.css")}}
	{{ HTML::style("bower_components/fullcalendar-scheduler/dist/scheduler.min.css")}}
	{{ HTML::style("bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css")}}
	{{ HTML::style("https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css")}}
	{{ HTML::style('css/media/media_max_1187.css') }}
	{{ HTML::style('css/media/media_max_978.css') }}
	@yield('styles')
	
</head>
<body>
	<div class="navbar">
		<div class="container">
			<a class="navbar-brand logosmall" href="/">{{ HTML::image('assets/images/kdglogo.png', 'alt-text') }}</a>
			@yield("nav")
		</div>
	</div>	
	<div class="container">
	    <div class="row">
	      <div class="col-md-10 col-md-offset-1">
	         @if(Session::has('success'))
	          <div class="text-center alert alert-success alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                  <p>{{ Session::get('success')}}</p>
	          </div>
	        @elseif(Session::has('error'))
	          <div class="text-center alert alert-danger alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                  <p>{{ Session::get('error')}}</p>
	          </div>
	        @elseif(count($errors->all()))
	          <div class="text-center alert alert-danger alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					@foreach($errors->all() as $error)
	                  <p>{{ $error}}</p>
	                @endforeach
	          </div>
	        @endif 
	      </div>
	    </div>
		@yield("content")
	</div>	
</body>
{{HTML::script("js/jquery-2.1.1.min.js")}}
{{ HTML::script("js/footable.all.min.js") }}
{{HTML::script("js/bootstrap.min.js")}}
{{HTML::script("https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js")}}
{{HTML::script("js/main.js")}}
{{HTML::script("/pickadate/lib/compressed/picker.js")}}
{{HTML::script("/pickadate/lib/compressed/picker.date.js")}}
{{HTML::script("/pickadate/lib/compressed/picker.time.js")}}
{{HTML::script("bower_components/moment/moment.js")}}
{{HTML::script("bower_components/fullcalendar/dist/fullcalendar.min.js")}}
{{HTML::script("bower_components/fullcalendar/dist/lang/nl.js")}}
{{HTML::script("bower_components/fullcalendar-scheduler/dist/scheduler.min.js")}}
{{HTML::script("bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js")}}
{{HTML::script("https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js")}}
@yield('scripts')
</html>