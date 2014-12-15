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

		@forelse($accesoriesCategorie as $accesorieCategorie)
		<h3>{{{$accesorieCategorie->name}}}</h3>
			@forelse($accesorieCategorie->materials as $material)
			<div>
				{{Form::checkbox('accessories[]', $material->id,in_array($material->id, $accessoriesOfMaterial));}}
				<p>{{$material->name}}</p>
				<img src="/images/{{$material->image}}" alt="">
			@empty
			<p>geen materiaal</p>
			@endforelse
		@empty
		<p>geen categorien</p>
		@endforelse
		
		{{Form::submit('verzend')}}
		{{Form::close()}}
	</div>
@stop