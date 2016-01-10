@extends('global.base')

@section('page-title')
Dashboard
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
@if($notifications != null)
	@if($notifications->count() != 0)
		<div class="row">
			@foreach($notifications as $notification)
				<div class="alert alert-warning col-md-12" role="alert">
					<div class="pull-left">
						<i class="fa fa-bell fa-2x fa-fw"></i>
					</div>
					<div class="pull-left">
						<p>
							{{ $notification->message}}
						</p>
						@if(Auth::user() && Auth::user()->type == "admin")
							<a href="{{ route('notifications.edit', ['id' => $notification->id]) }}" class="btn btnDefault"><i class="fa fa-edit"></i>Bewerken</a>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	@else
		<div class="row">
			<div class="alert alert-info col-md-12" role="alert">
				<div class="pull-left">
					<i class="fa fa-bell-slash-o fa-5x fa-fw"></i>
				</div>
				<div>
					<h3>Geen notificaties</h3>
					<p>
						Er zijn momenteel geen notificaties. Maar als er notificaties zijn komen deze hier tevoorschijn.
					</p>
				</div>
			</div>
		</div>
	@endif
@else
	<div class="row">
		<div class="alert alert-info col-md-12" role="alert">
			<div class="pull-left">
				<i class="fa fa-bell-slash-o fa-5x fa-fw"></i>
			</div>
			<div>
				<h3>Geen notificaties</h3>
				<p>
					Er zijn momenteel geen notificaties. Maar als er notificaties zijn komen deze hier tevoorschijn.
				</p>
			</div>
		</div>
	</div>
@endif
<div class="row">
	<div class="col-md-6 jumbo">
		<div class="row">
			<div class="col-xs-2">
				<i class="fa fa-calendar fa-fw fa-4x"></i>
			</div>
			<div class="col-xs-10">
				<h1>Reserveren</h1>
				<p>
					Bekijk hier de kalender per categorie en reserveer je materiaal.
				</p>
				<p><a class="btn btn-primary btn-lg" href="/materials" role="button">Reserveren</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-6 jumbo">
		<div class="row">
			<div class="col-xs-2">
				<i class="fa fa-calendar-check-o fa-fw fa-4x"></i>
			</div>
			<div class="col-xs-10">
				<h1>Mijn Reservaties</h1>
				<p>
					Bekijk hier de door je reeds gemaakte reservaties. <br>
					Je kan deze ook nog steeds annuleren indien nodig.
				</p>
				<p><a class="btn btn-primary btn-lg" href="/myreservations" role="button">Mijn Reservaties</a></p>
			</div>
		</div>
	</div>
</div>
@stop