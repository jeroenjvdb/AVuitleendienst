@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Materiaal Toevoegen</h1>
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
			{{Form::label('naam','Naam:')}}
			{{Form::text('name','',array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('image','Afbeelding:')}}
			{{Form::file('image')}}	
		</div>
		<div>
			{{Form::label('barcode','Barcode:')}}
			{{Form::text('barcode','',array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('categorei','Categorie:')}}
			{{Form::select('categorie', $categories)}}
		</div>
		<div>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details','',array('required' => 'required','rows' => '4'))}}			
		</div>
		<h2>Selecteer de bijhorende Accessiores</h2>
		@foreach($accessories as $accessore)
			<div>
				{{Form::checkbox('accessories[]', $accessore->id);}}
				<p>{{$accessore->name}}</p>
				<img src="/images/{{$accessore->image}}" alt="">
			</div>	
		@endforeach
		{{Form::submit('verzend')}}
		{{Form::close()}}
	</div>
@stop