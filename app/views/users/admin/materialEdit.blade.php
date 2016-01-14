@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Materiaal Aanpassen</h1>
	</div>
	<div>
		{{Form::open(['route' => ['materials.update',$material->id],'files' => true,'method' => 'PUT'])}}
		<div>
			{{ $errors->first('image')}}
			{{ $errors->first('barcode')}}
		</div>
		<div>
			{{Form::label('naam','Naam:')}}<br>
			{{Form::text('name',$material->name,array('required' => 'required','class' => 'form-control'))}}			
		</div>
		<div>
		<br>
			{{Form::label('image','Afbeelding:')}}<br>
			<img width="200px" src="/images/{{$material->image}}" alt="">
			{{Form::file('image')}}	
		</div>
		<div>
		<br>
			{{Form::label('status','Status:')}}<br>
			{{Form::select('status',array('ok' => 'ok' , 'missing' => 'vermist' , 'broken' => 'defect'),'',array('class' => 'form-control'))}}

		</div>
		<div>
		<br>
			{{Form::label('barcode','Barcode:')}}<br>
			{{Form::text('barcode',$material->barcode,array('required' => 'required','class' => 'form-control'))}}			
		</div>
		<div>
		<br>
			{{Form::label('categorei','Categorie:')}}<br>
			{{Form::select('categorie', $categories,$material->categories[0]->id,array('class' => 'form-control'))}}
		</div>
		<div>
		<br>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details',$material->details,array('required' => 'required','rows' => '3','class' => 'form-control'))}}			
		</div>
	</div>
	<div>
		<h2>Selecteer de bijhorende accessiores</h2>
		@foreach($accesoriesCategorie as $accesorieCategorie)
		<div class="item">
			<h3>{{$accesorieCategorie->name}}</h3>
			@foreach($accesorieCategorie->materials as $material)
				<div>
					{{Form::checkbox('accessories[]', $material->id);}}			
					<p>{{$material->name}}</p>
					<img src="/images/{{$material->image}}" width="100px" alt="">
				</div>
			@endforeach
		</div>
		@endforeach
		<br>
		{{Form::submit('Toevoegen',array('class' => 'btn btnDefault'))}}
		{{Form::close()}}
		<br><br>
	</div>
@stop