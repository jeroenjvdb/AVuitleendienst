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
			{{Form::label('naam','Naam:')}}<br>
			{{Form::text('name',$material->name,array('required' => 'required'))}}			
		</div>
		<div>
		<br>
			{{Form::label('image','Afbeelding:')}}<br>
			<img src="/images/{{$material->image}}" alt="">
			{{Form::file('image')}}	
		</div>
		<div>
		<br>
			{{Form::label('status','Status:')}}<br>
			{{Form::select('status',array('ok' => 'ok' , 'missing' => 'vermist' , 'broken' => 'defect'))}}

		</div>
		<div>
		<br>
			{{Form::label('barcode','Barcode:')}}<br>
			{{Form::text('barcode',$material->barcode,array('required' => 'required'))}}			
		</div>
		<div>
		<br>
			{{Form::label('categorei','Categorie:')}}<br>
			{{Form::select('categorie', $categories,$material->categories[0]->id)}}
		</div>
		<div>
		<br>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details',$material->details,array('required' => 'required','rows' => '3'))}}			
		</div>

		<h2>Selecteer de bijhorende accessiores</h2>

		@forelse($accesoriesCategorie as $accesorieCategorie)
		<h3>{{{$accesorieCategorie->name}}}</h3>
			@forelse($accesorieCategorie->materials as $material)
			<div>
				{{Form::checkbox('accessories[]', $material->id,in_array($material->id, $accessoriesOfMaterial));}}
				<p>{{$material->name}}</p>
				<img width="100px" src="/images/{{$material->image}}" alt="">
			@empty
			<p>Geen materiaal beschikbaar</p>
			@endforelse
		@empty
		<p>Geen categorieën beschikbaar</p>
		@endforelse
		<br>
		{{Form::submit('Wijzigen',array('class' => 'btn btnreg btn-success btn-default'))}}
		<br><br>
		{{Form::close()}}
	</div>
@stop