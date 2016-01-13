@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<div class="title">
		<h1>Beheer</h1>
	</div>

<div class="beheer">   
	<div> 
		<a href="/beheer/materiaal">
		    <button class="btn btnDefault">Materiaalbeheer</button>
		</a>
	</div>
	<div>
		<a href="/beheer/gebruikers">
		    <button class="btn btnDefault">Studentenbeheer</button>
		</a>
	</div>
	<div>
		<a href="{{ route('setBaseLaptop') }}">
			<button class="btn btnDefault">reservatiebeheer</button>
		</a>
	</div>
</div>
<div>
	@if(!$messages->isEmpty())
		<h2>Berichten</h2>
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Titel</th>
					<th>Bericht</th>
					<th>Status</th>
					<th>Afzender</th>
					<th>Naam van materiaal</th>
					<th>Materiaal status</th>
				</tr>
				@foreach($messages as $message)
					@if($message->materials->status == "missing")
					<tr class="warning">
					@elseif($message->materials->status == "broken")
					<tr class="danger">
					@elseif($message->materials->status == "ok")
					<tr>
					@endif
						<td>{{$message->title}}</td>
						<td>{{$message->message}}</td>
						<td>{{Form::open(['url' => 'messages/'.$message->id , 'method' => 'PUT'])}}
							{{Form::select('status', array('unsolved' => 'onopgelost', 'solved' => 'opgelost'), $message->status,array("onchange" => "this.form.submit()"))}}
							{{Form::hidden('materialid',$message->materials->id)}}
							{{Form::close()}}</td>
						<td>{{$message->users->lastname.' '.$message->firstname}}</td>
						<td>{{$message->materials->name}}</td>
						<td>{{$message->materials->status}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		
	@endif
</div>

@stop