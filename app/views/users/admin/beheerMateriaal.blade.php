@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> Materiaal</span>
	<h2>Beheer Materiaal</h2>
	<div>
		@if(Session::has('message'))
	        <div>{{ Session::get('message')}}</div>
	    @endif
	</div>
	<div class="loginbox">    
		<a href="/materials/create">
		    <button class="btn btnreg btn-success btn-default">Materiaal toevoegen</button>
		</a>
		<a href="/categories/create">
		    <button class="btn btnreg btn-success btn-default">Categorie toevoegen</button>
		</a>
	</div>
	<div>
		@forelse($categories as $categorie)

			<div class="category">
				
				<h3>{{$categorie->name}}</h3>
				
				<a href="{{URL::route('categories.edit', $categorie->id)}}" class="btn btn-sm btn-default pull-left"><i class="fa fa-gear"></i></a>
				{{ Form::open(['route' => ['categories.destroy', $categorie->id], 'method' => 'delete']) }}
			    <button type="submit" class="btn btn-sm btn-danger pull-left"><i class="fa fa-remove"></i></button>
				{{ Form::close() }}
			</div>
			@if(!$categorie->materials->isEmpty())
			<div class="col-md-12 table-responsive">
				<table class="table">
					<tr>
						<th>Naam</th>
						<th>Status</th>
						<th>Barcode</th>
						<th></th>
					</tr>
					@foreach($categorie->materials as $material)
					@if ($material->status == "broken")
					<tr class="danger">
					@elseif ($material->status == "missing")
							<tr class="warning">
					@else
						<tr>
					@endif
						<td>{{link_to('materials/'.$material->id,$material->name)}}</td>
						<td>{{$material->status}}</td>
						<td>{{$material->barcode}}</td>
						<td>
							{{ Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) }}
						    <button type="submit" class="btn btn-sm btn-danger pull-right"><i class="fa fa-remove"></i></button>
							{{ Form::close() }}
							<a href="{{URL::route('materials.edit', $material->id)}}" class="btn btn-sm btn-default pull-right"><i class="fa fa-gear"></i></a>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
			@else
			<h4 class="notification">Geen materiaal beschikbaar</h4>
			@endif
			
		@empty
		<h4 class="notification">Geen categorieën beschikbaar</h4>
		@endforelse
	</div>

@stop