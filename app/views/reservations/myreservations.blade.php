@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>My reservations</h1>
	@forelse($reservations as $reservation)
		<h2>{{$reservation->name}}</h2>
		<img src="/images/{{$reservation->image}}" alt="">
		<p>{{$reservation->reason}}</p>
		<p>Begin: {{$reservation->begin}}</p>
		<p>End: {{$reservation->end}}</p>
	@empty
		<p>U heeft op dit moment nog geen reservaties geplaatst.</p>
	@endforelse
@stop