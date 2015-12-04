@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>{{{$material->name}}} Reserveren</h1>
	{{Form::open(['route' => 'reservations.store', "class" => "form-horizontal"])}}
	<div>
		{{str_replace('begin','begin datum',str_replace('end', 'eind datum', $errors->first('end')))}}
		@if(Session::has('message') )
			{{Session::get('message')}}
		@endif
	</div>
		{{Form::hidden('materialId',$material->id)}}
	<div class="form-group">
		{{Form::label('begin','Begin datum: ', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label"])}}
		<div class="col-sm-8">
			{{Form::text('beginDate',$begin,array('required' => 'required','readonly', "class" => "form-control cursorpointer border"))}}
			{{Form::text('beginHour',$beginHour,array('required' => 'required','readonly', "class" => "form-control cursorpointer border"))}}
		</div>
		
	</div>
	<div class="form-group">
		{{Form::label('einde','Eind datum: ', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label border"])}}
		<div class="col-sm-8">
			{{Form::text("endDate",'',array('placeholder' => 'kies een datum','id'=>'date', "class" => "form-control cursorpointer border"))}}
		{{Form::text("endHour",'',array('placeholder' => 'kies een uur','id'=>'time', "class" => "form-control cursorpointer border"))}}
		</div>
		
	</div>
	<div class="form-group">
		{{Form::label('Reden','Reden van reservatie: ', ["class" => "col-sm-4 col-md-3 col-xs-12 control-label"])}}
		<div class="col-sm-8">
			{{Form::textarea('reason','',array('required' => "required", "class" => "form-control border", "rows" => "2"))}}
		</div>
		
	</div>
	<div class="form-group">
		<h3 class="itemrestitle">Mede gebruikers selecteren:</h3>
		@forelse($users as $user)
			<div class="col-sm-4 col-md-3 col-xs-12">
				<label class="checkbox-inline">
					{{Form::checkbox('users[]', $user->id);}}
					{{{$user->firstname." ".$user->lastname}}}
				</label>
			</div>
		@empty
			<h4 class="notification">Er zijn nog geen gebruikers</h4>
		@endforelse
		{{$users->links()}}
	</div>
	<div class="form-group">
		<h3 class="itemrestitle">Extra accesoires</h3>
		@forelse($material->accessories as $accessorie)
		<div class="col-md-4 col-sm-6 col-xs-12 extracc">
			<div class="thumbnail loginbox loginboxinner loginboxshadow">
				{{Form::checkbox('accessories[]', $accessorie->id, false, ["class" => "checkbox checker"]);}}
				<h4 class="success">{{{$accessorie->name}}}</h4>
				<img src="/images/{{$accessorie->image}}" alt="{{{$accessorie->name}}}" class="img-rounded">
			</div>
		</div>	
		@empty
			<h4 class="notification">Bij dit item horen er geen accesoires</h4>
		@endforelse

	</div>
	<div class="loginbox confirm">
		{{Form::submit('Bevestigen', ["class" => "btn btnreg btn-success"])}}
	</div>
	
	{{Form::close()}}

@stop