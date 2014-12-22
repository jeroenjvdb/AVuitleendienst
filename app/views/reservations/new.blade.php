@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>{{{$material->name}}} Reserveren</h1>
	{{Form::open(['route' => 'reservations.store'])}}
	<div>
		{{Form::label('begin','Begin datum: ')}}
		{{Form::text('begin',$begin,array('required' => 'required'))}}
	</div>
	<div>
		{{Form::label('einde','Eind datum: ')}}
		{{Form::text('end','',array('required' => 'required'))}}
	</div>
	<div>
		{{Form::label('Reden','Reden van reservatie: ')}}
		{{Form::textarea('reason','',array('required' => "required"))}}
	</div>
	<div>
		{{Form::label('mede gebruikers','Medeontleenders: ')}}
		{{Form::select('users',array('1' => 'gebruiker1' , '2' => 'gebruiker2'))}}
	</div>
	<div>
		<h3>Extra accesoires</h3>
		@forelse($material->accessories as $accessorie)
			{{Form::checkbox('accessories[]', $accessorie->id);}}
			<img src="/images/{{$accessorie->image}}" alt="{{{$accessorie->name}}}">
			<p>{{{$accessorie->name}}}</p>
		@empty
			<p>Bij dit item horen er geen accesoires</p>
		@endforelse

	</div>
	{{Form::submit('bevestigen')}}
	{{Form::close()}}
@stop