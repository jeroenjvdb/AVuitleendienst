@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	@if(count($reservations) > 0)

		<div class="panel panel-default" style="clear:both;">
			<div class="panel-heading">
				<h1>Laatste reservaties van {{$reservations[0]->name}}</h1>
			</div>

			<!-- Search table -->
			<div class="panel-body">
				<div class="form-group">
					<div class="input-group">
						<input id="filter" type="text" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control input-sm bg-light no-border rounded padder" placeholder="Zoek...">
						<span class="input-group-btn heading-button">
							<button type="submit" class="btn btn-lg bg-light rounded"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
	
			<table class="footable table m-b-none toggle-arrow" ui-jq="footable" data-filter="#filter" data-page-size="10">
				<thead>
					<tr>
						<th data-sort-initial="true">Naam</th>
						<th data-hide="phone">Email</th>
						<th data-hide="phone">Reden</th>
						<th data-hide="tablet,phone">Datum afgehaald</th>
						<th data-hide="tablet,phone">Datum teruggebracht</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reservations as $reservation)
						<tr>
							<td>{{$reservation->firstname}} {{$reservation->lastname}}</td>
							<td>{{$reservation->email}}</td>
							<td>{{{$reservation->reason}}}</td>
							<td>{{{$reservation->datecheckedin}}}</td>
							<td>{{{$reservation->datecheckedout}}}</td>
						</tr>
					@endforeach
				</tbody>
	
				<!-- Table footer -->
				<tfoot class="hide-if-no-paging">
					<tr>
						<td colspan="6" class="text-center">
							<ul class="pagination"></ul>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	@else
		<h4 class="notification">Dit product is nog niet gereserveerd geweest</h4>
	@endif

@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop