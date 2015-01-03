@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div>
		@if(!empty($reservations))
			<h1>Laatste reservaties van {{$reservations[0]->name}}</h1>
			<table>
				<tr>
					<th>Naam</th>
					<th>Reden</th>
					<th>datum ingechecked</th>
					<th>datum uitgechecked</th>
					
				</tr>
			@foreach($reservations as $reservation)
				<tr>
					<td>{{$reservation->firstname}} {{$reservation->lastname}}</td>
					<td>{{{$reservation->reason}}}</td>
					<td>{{{$reservation->datecheckedin}}}</td>
					<td>{{{$reservation->datecheckedout}}}</td>
				</tr>
			@endforeach
			</table>
			{{$reservations->links()}}
		@else
			<p>Dit product is nog niet gereserveerd geweest</p>
		@endif
	</div>

@stop