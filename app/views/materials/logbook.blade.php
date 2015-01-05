@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")

<h1 class="logtitle">Logboek</h1>
	<div>
		{{Form::open(['url' => 'logbook/search', "class" => "form"])}}
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12">
					{{Form::label('search','Op naam:', ["class" => "control-label"])}}
					{{Form::text('search',Session::has('input') ? Session::get('input')['search'] :'',array('placeholder' => 'materiaal zoeken', "class" => "form-control"))}}

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
					{{Form::submit('Zoek', ["class" => "btn btnstyle btn-submit btn-info"])}}
				</div>
			</div>
		{{Form::close()}}
	</div>

	
	<div class="col-md-12 table-responsive">

		<table class="table">
			<tr>
				<th>Naam</th>
				<th>Afbeelding</th>
				<th>Status</th>
				<th>Beschikbaarheid</th>
				<th>Barcode</th>
			</tr>
		@foreach($logbook as $material)
			@if ($material->status == "broken")
					<tr class="danger">
			@elseif ($material->status == "missing")
					<tr class="warning">
			@else
				<tr>
			@endif
				<td>{{link_to('logbook/'.$material->id,$material->name)}}</td>
				<td><img src="/images/{{$material->image}}" alt="{{$material->name}}"></td>
				<td>{{{$material->status}}}</td>
				<td>{{{$material->availability}}}</td>
				<td>{{{$material->barcode}}}</td>
			</tr>
		@endforeach
		</table>
		@if($paginate)
			{{$logbook->links()}}
		@endif
	</div>

@stop