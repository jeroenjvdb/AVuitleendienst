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
		@if($errors->first('end'))
			<p>Een geldige eind datum is verplicht</p>
		@endif
		@if(Session::has('message') )
			{{Session::get('message')}}
		@endif
	</div>
		{{Form::hidden('materialId',$material->id)}}
	<div>
		{{Form::label('begin','Begin datum: ')}}
		{{Form::text('begin',$begin,array('required' => 'required'))}}
	</div>
	<div>
		{{Form::label('einde','Eind datum: ')}}
		{{Form::text("endDate",'',array('placeholder' => 'kies een datum','id'=>'date'))}}
		{{Form::text("endHour",'',array('placeholder' => 'kies een uur','id'=>'time'))}}
	</div>
	<div>
		{{Form::label('Reden','Reden van reservatie: ')}}
		{{Form::textarea('reason','',array('required' => "required"))}}
	</div>
	<div>
		<h3>mede gebruikers selecteren</h3>
		@forelse($users as $user)
			{{Form::checkbox('users[]', $user->id);}}
			<p>{{{$user->firstname." ".$user->lastname}}}</p>
		@empty
			<p>Er zijn nog geen gebruikers</p>
		@endforelse
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