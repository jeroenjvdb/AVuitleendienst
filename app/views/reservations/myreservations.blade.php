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

	@if(count($reservations) > 0)
		<table class="footable table m-b-none toggle-arrow" ui-jq="footable" data-filter="#filter" data-page-size="10">
			<thead>
				<tr>
					<th>Item</th>
					<th data-hide="phone" data-sort-initial="true">Van</th>
					<th data-hide="phone">Tot</th>
					<th data-hide="all">Reden</th>
					<th data-hide="all">Foto</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reservations as $reservation)
					<tr>
						<td>{{$reservation->name}}</td>
						<td>{{ date('Y/m/d - H:i', strtotime($reservation->begin)) }}</td>
						<td>{{ date('Y/m/d - H:i', strtotime($reservation->end)) }}</td>
						<td>{{$reservation->reason}}</td>
						<td><img src="/images/{{$reservation->image}}" alt=""></td>
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
	@else
		<h4 class="notification">Je hebt geen openstaande reservaties.</h4>
	@endif

@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop