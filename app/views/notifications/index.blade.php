@extends('global.base')

@section('page-title')
	Notification aanpassen
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
	<div class="title">
		<h1>Notificaties</h1>
	</div>
	<div class="alert alert-info">
		<p>Notificaties waarvan start of stop datum een maand verschillen met nu worden niet meer getoond.</p>
	</div>
	<a href="{{route('notifications.create')}}" class="btn btnDefault"><i class="fa fa-plus"></i> Notificatie toevoegen</a>
	@if(count($notifications) > 0)
		<table class="footable table m-b-none toggle-arrow" ui-jq="footable" data-filter="#filter" data-page-size="10">
			<thead>
				<tr>
					<th>Bericht</th>
					<th>Belangrijk</th>
					<th>Zichtbaar van</th>
					<th>Zichtbaar tot</th>
					<th data-hide="all">Volledig bericht</th>
					<th data-sort-ignore="true"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($notifications as $notification)
					<tr>
						<td>{{ mb_strimwidth($notification->message, 0, 25,"...")}}</td>
						<td>
							@if($notification->important)
								<i class="fa fa-check fa-2x"></i>
							@else
								<i class="fa fa-times fa-2x"></i>
							@endif
						</td>
						<td>{{ date('Y/m/d - H:i', strtotime($notification->show_from)) }}</td>
						<td>{{ date('Y/m/d - H:i', strtotime($notification->show_until)) }}</td>
						<td>{{$notification->message}}</td>
						<td>
							<a class="btn btn-danger" href="{{route('notifications.destroy', $notification->id)}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							<a class="btn btn-info" href="{{route('notifications.destroy', $notification->id)}}"><i class="fa fa-edit"></i></a>
						</td>
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
		<h4 class="notification">Er zijn geen notificaties meer om te bewerken.</h4>
	@endif
@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop