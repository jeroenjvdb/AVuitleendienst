@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Mijn reservaties</h1>
	</div>
	@forelse($reservations as $reservation)
	<div class="span4Container">
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 span4">
			<div class="thumbnail tnDate">
				<a href="#" class="item">
					<h3>{{$reservation->name}}</h3>
					<img src="/images/{{$reservation->image}}" alt="">
				</a>
				<p>{{$reservation->reason}}</p>
				<p class="infogreen">Begin: {{$reservation->begin}}</p>
				<p class="infored">Einde: {{$reservation->end}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 span4">
			<div class="thumbnail tnDate">
				<a href="#" class="item">
					<h3>{{$reservation->name}}</h3>
					<img src="/images/{{$reservation->image}}" alt="">
				</a>
				<p>{{$reservation->reason}}</p>
				<p class="infogreen">Begin: {{$reservation->begin}}</p>
				<p class="infored">Einde: {{$reservation->end}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 span4">
			<div class="thumbnail tnDate">
				<a href="#" class="item">
					<h3>{{$reservation->name}}</h3>
					<img src="/images/{{$reservation->image}}" alt="">
				</a>
				<p>{{$reservation->reason}}</p>
				<p class="infogreen">Begin: {{$reservation->begin}}</p>
				<p class="infored">Einde: {{$reservation->end}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 span4">
			<div class="thumbnail tnDate">
				<a href="#" class="item">
					<h3>{{$reservation->name}}</h3>
					<img src="/images/{{$reservation->image}}" alt="">
				</a>
				<p>{{$reservation->reason}}</p>
				<p class="infogreen">Begin: {{$reservation->begin}}</p>
				<p class="infored">Einde: {{$reservation->end}}</p>
			</div>
		</div>
	</div>
		
	@empty
		<h4 class="notification">U heeft op dit moment nog geen reservaties geplaatst.</h4>
	@endforelse
@stop