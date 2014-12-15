@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> <a href="/beheer/materiaal">Materiaal </a>> Edit Materiaal</span>
	<h2>Edit Materiaal</h2>
	<div>
		{{Form::open(['route' => ['materials.update',$material->id],'files' => true,'method' => 'PUT'])}}
		<div>
			{{ $errors->first('image')}}
			{{ $errors->first('barcode')}}
		</div>
		<div>
			{{Form::label('naam','Naam:')}}
			{{Form::text('name',$material->name,array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('image','Afbeelding:')}}
			<img src="/images/{{$material->image}}" alt="">
			{{Form::file('image')}}	
		</div>
		<div>
			{{Form::label('barcode','Barcode:')}}
			{{Form::text('barcode',$material->barcode,array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('categorei','Categorie:')}}
			{{Form::select('categorie', $categories,$material->categories[0]->id)}}
		</div>
		<div>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details',$material->details,array('required' => 'required','rows' => '4'))}}			
		</div>

		<h2>Selecteer de bijhorende Accessiores</h2>

		@foreach($accessories as $accessore)
			<div>
				{{Form::checkbox('accessories[]', $accessore->id,in_array($accessore->id, $accessoriesOfMaterial))}}
				<p>{{$accessore->name}}</p>
				<img src="/images/{{$accessore->image}}" alt="">
			</div>	
		@endforeach
		
		{{Form::submit('verzend')}}
		{{Form::close()}}
	</div>
@stop