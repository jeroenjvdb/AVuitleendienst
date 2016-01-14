@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Materiaal Toevoegen</h1>
	</div>
	@if(Session::has('message'))
        <div>{{ Session::get('message')}}</div>
    @endif
	<div>
		{{Form::open(['route' => 'materials.store','files' => true])}}
		<div>
			{{ $errors->first('image')}}
			{{ $errors->first('barcode')}}
		</div>
		<div>
			{{Form::label('naam','Naam:')}}<br>
			{{Form::text('name','',array('required' => 'required','class' => 'form-control'))}}			
		</div>
		<div><br>
			{{Form::label('image','Afbeelding:')}}<br>
			{{Form::file('image')}}	
		</div>
		<div><br>
			{{Form::label('barcode','Barcode:')}}<br>
			{{Form::text('barcode','',array('required' => 'required','class' => 'form-control'))}}			
		</div>
		<div><br>
			{{Form::label('categorei','Categorie:')}}<br>
			{{Form::select('categorie', $categories,'',array('class' => 'form-control'))}}
		</div>
		<div><br>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details','',array('required' => 'required','rows' => '3','class' => 'form-control'))}}			
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