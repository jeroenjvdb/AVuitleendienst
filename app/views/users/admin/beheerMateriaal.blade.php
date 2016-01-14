@extends("global.base")

@section("page-title")
	Materiaal Beheer
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<!-- <span><a href="/beheer">Beheer </a>> Materiaal</span> -->
	<div class="title">
		<h1>Beheer Materiaal</h1>
	</div>
	
	@if(Session::has('message'))
		<div>
        	<div>{{ Session::get('message')}}</div>
        </div>
    @endif
	
	<div class="buttonBox">    
		<a href="/materials/create">
		    <button class="btn btnreg btnDefault btn-default"><i class="fa fa-plus"></i> Materiaal toevoegen</button>
		</a>
		<a href="/categories/create">
		    <button class="btn btnreg btnDefault btn-default"><i class="fa fa-plus"></i> Categorie toevoegen</button>
		</a>
	</div>
	<div class="selectBox">
		<h2>Weergeef</h2>
		<div class="form-group">
			<select class="form-control text-center" id="categorySelect">
			@forelse($categories as $categorie)
					<option class="text-center" value="{{$categorie->id}}">{{{ucfirst($categorie->name)}}}</option>
				@empty
					<option value="0"></option>
			@endforelse
			</select>
		</div>
	</div>
	<div>
		@forelse($categories as $categorie)

			@if(count($categorie->materials) > 0)
				<div class="col-md-12 table-responsive category" id="category{{$categorie->id}}">

					<!-- Search table -->
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input id="filter{{$categorie->id}}" type="text" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control input-sm bg-light no-border rounded padder" placeholder="Zoek...">
								<span class="input-group-btn heading-button">
									<button type="submit" class="btn btn-lg bg-light rounded"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>

					<table class="footable table m-b-none toggle-arrow" ui-jq="footable" data-filter="#filter{{$categorie->id}}" data-page-size="10">
						<thead>
							<tr>
								<th data-sort-initial="true">Naam</th>
								<th data-hide="phone">Status</th>
								<th data-hide="tablet">Barcode</th>
								<th data-sort-ignore="true"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($categorie->materials as $material)
								@if ($material->status == "broken")
									<tr class="danger">
								@elseif ($material->status == "missing")
									<tr class="warning">
								@else
									<tr>
								@endif
								<td>{{link_to('materials/'.$material->id,ucfirst($material->name))}}</td>
								<td>{{$material->status}}</td>
								<td>{{$material->barcode}}</td>
								<td>
									{{ Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) }}
								    <button type="submit" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></button>
									{{ Form::close() }}
									<a href="{{URL::route('materials.edit', $material->id)}}" class="btn btn-sm btn-default pull-right"><i class="fa fa-edit"></i></a>
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
					<h4 class="notification">Geen materiaal beschikbaar.</h4>
				@endif

			
		@empty
		<h4 class="notification">Geen categorieën beschikbaar</h4>
		@endforelse
	</div>

@stop

@section('scripts')
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>
@stop