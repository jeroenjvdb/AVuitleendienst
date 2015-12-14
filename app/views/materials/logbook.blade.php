@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

	<div class="title">
		<h1>Logboek</h1>
	</div>
	<div class="">
		{{Form::open(['url' => 'logbook/search', "class" => "form"])}}
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12">
					{{Form::label('categorie','Categorie:', ["class" => "control-label"])}}
					{{Form::select('categorie',$categories,Session::has('input') ? Session::get('input')['categorie'] :'all', ["class" => "form-control"])}}
				</div>
				

				<div class="col-md-6 col-sm-6 col-xs-12">
					{{Form::label('status','Status:', ["class" => "control-label"])}}
					{{Form::select('status',array('all' => 'alle','ok' =>'ok' , 'missing' => 'missing' , 'broken' => 'broken', ),Session::has('input') ? Session::get('input')['status'] :'all', ["class" => "form-control"])}}


					{{Form::label('beschikbaarheid','Beschikbaarheid:', ["class" => "control-label"])}}
					{{Form::select('availability',array('all' => 'alle' ,'beschikbaar' => 'beschikbaar' ,'uitgeleend' => 'uitgeleend', ),Session::has('input') ? Session::get('availability')['search'] :'all', ["class" => "form-control"])}}
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 logsearchbtn">
					{{Form::submit('Zoek', ["class" => "btn btnDefault"])}}
				</div>
			</div>
		{{Form::close()}}
	</div>

	<!-- Afbeelding van het materiaal weergeven? -->
	{{-- <td><img src="/images/{{$material->image}}" alt="{{$material->name}}"></td> --}}
	

	<div class="panel panel-default" style="clear:both;">
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
	
		@if(count($logbook) > 0)
			<table class="footable table m-b-none toggle-arrow" ui-jq="footable" data-filter="#filter" data-page-size="10">
				<thead>
					<tr>
						<th data-sort-initial="true">Naam</th>
						<th data-hide="phone">Status</th>
						<th data-hide="tablet,phone">Beschikbaarheid</th>
						<th data-hide="tablet,phone">Barcode</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($logbook as $material)
						@if ($material->status == "broken")
							<tr class="danger">
						@elseif ($material->status == "missing")
							<tr class="warning">
						@else
							<tr>
						@endif
							<td>{{link_to('logbook/'.$material->id,$material->name)}}</td>
							<td>{{{$material->status}}}</td>
							<td>{{{$material->availability}}}</td>
							<td>{{{$material->barcode}}}</td>
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
			<h4 class="notification">Er is nog geen materiaal om weer te geven.</h4>
		@endif
	</div>

	

@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop