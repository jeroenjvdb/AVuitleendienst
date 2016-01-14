@extends("global.base")

@section("page-title")
	Gebruiker beheer
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<!-- <span><a href="/beheer">Beheer </a>> Gebruikers</span> -->
	<div class="title">
		<h1>Beheer Gebruikers</h1>
	</div>

	@if(count($gebruikers) > 0)

		<!-- Search table -->
		<div class="panel-body">
			<div class="buttonBox">    
				<a href="/users/create">
				    <button class="btn btnreg btnDefault btn-default"><i class="fa fa-plus"></i> Nieuwe gebruiker aanmaken</button>
				</a>
			</div>
			<div class="form-group altSearch">
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
					<th data-sort-initial="true">Voornaam</th>
					<th>Achternaam</th>
					<th data-hide="phone">Email</th>
					<th data-hide="tablet,phone">Rol</th>
					<th data-sort-ignore="true" data-hide="tablet,phone"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($gebruikers as $gebruiker)
					<tr>
						<td>{{{$gebruiker->firstname}}}</td>
						<td>{{{$gebruiker->lastname}}}</td>
						<td><a href="mailto:example@tutorialspark.com">{{{$gebruiker->email}}}</a></td>
						@if($gebruiker->type == "teacher")
							<td>Leerkracht</td>
						@elseif($gebruiker->type == "monitor")
							<td>Monitor</td>
						@elseif($gebruiker->type == "student")
							<td>Student</td>
						@else
							<td>Admin</td>
						@endif

						<td>
							<a href="{{URL::to('users/' . $gebruiker->id . '/delete')}}" class="btn btn-sm btn-danger pull-right"><i class="fa fa-remove"></i></a>
							<a href="{{URL::to('users/' . $gebruiker->id . '/edit')}}" class="btn btn-sm btn-default pull-right"><i class="fa fa-edit"></i></a>
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
		<h4 class="notification">Er zijn nog geen gebruikers</h4>
	@endif

@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop