@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div>
		{{Form::open(['url' => 'logbook/search'])}}
			<div>
				{{Form::text('search',Session::has('input') ? Session::get('input')['search'] :'',array('placeholder' => 'materiaal zoeken'))}}
				{{Form::label('status','Status:')}}
				{{Form::select('status',array('all' => 'alle','ok' =>'ok' , 'missing' => 'missing' , 'broken' => 'broken'),Session::has('input') ? Session::get('input')['status'] :'all')}}
				{{Form::label('beschikbaarheid','Beschikbaarheid:')}}
				{{Form::select('availability',array('all' => 'alle' ,'beschikbaar' => 'beschikbaar' ,'uitgeleend' => 'uitgeleend'),Session::has('input') ? Session::get('availability')['search'] :'all')}}
				{{Form::label('categorie','Categorie:')}}
				{{Form::select('categorie',$categories,Session::has('input') ? Session::get('input')['categorie'] :'all')}}
				{{Form::submit('zoek')}}
			</div>
		{{Form::close()}}
	</div>
	<h1>Logboek</h1>
	<div>
		<table>
			<tr>
				<th>Naam</th>
				<th>Afbeelding</th>
				<th>Status</th>
				<th>Beschibaarheid</th>
				<th>Barcode</th>
			</tr>
		@foreach($logbook as $material)
			<tr>
				<td>{{link_to('logbook/'.$material->id,$material->name)}}</td>
				<td><img src="/images/{{$material->image}}" alt=""></td>
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