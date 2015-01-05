@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Mijn reservaties</h1>
	@forelse($reservations as $reservation)
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="thumbnail loginbox loginboxinner loginboxshadow myreservation">
			<h2 class="centering">{{link_to('materials/'.$reservation->fk_materialsid,$reservation->name)}}</h2>
			<img src="/images/{{$reservation->image}}" alt="">
			<p>{{$reservation->reason}}</p>
			<p class="infogreen">Begin: {{$reservation->begin}}</p>
			<p class="infored">Einde: {{$reservation->end}}</p>
		</div>
	</div>
		
	@empty
		<h4 class="notification">U heeft op dit moment nog geen reservaties geplaatst.</h4>
	@endforelse
@stop