@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> <a href="/beheer/materiaal">Materiaal </a>> Materiaal Toevoegen</span>
	<h2>Materiaal Toevoegen</h2>
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
			{{Form::text('name','',array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('image','Afbeelding:')}}<br>
			{{Form::file('image')}}	
		</div>
		<div>
			{{Form::label('barcode','Barcode:')}}<br>
			{{Form::text('barcode','',array('required' => 'required'))}}			
		</div>
		<div>
			{{Form::label('categorei','Categorie:')}}<br>
			{{Form::select('categorie', $categories)}}
		</div>
		<div>
			{{Form::label('details','Details:')}}
			<br/>
			{{Form::textarea('details','',array('required' => 'required','rows' => '3'))}}			
		</div>
		<h2>Selecteer de bijhorende accessiores</h2>
		@forelse($accesoriesCategorie as $accesorieCategorie)
		<h3>{{{$accesorieCategorie->name}}}</h3>
			@forelse($accesorieCategorie->materials as $material)
			<div>
					{{Form::checkbox('accessories[]', $material->id);}}			
					<p>{{$material->name}}</p>
					<img src="/images/{{$material->image}}" width="100px" alt="">
				@empty
				<h4 class="notification">Geen materiaal</h4>
			@endforelse
		@empty
		<h4 class="notification">geen categorien</h4>
		@endforelse
		<br>
		{{Form::submit('Toevoegen',array('class' => 'btn btnreg btn-success btn-default'))}}
		{{Form::close()}}
		<br><br>
	</div>
@stop