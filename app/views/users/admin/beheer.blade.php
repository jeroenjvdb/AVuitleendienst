@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<h1>Beheer</h1>

<div class="loginbox">    
	<a href="/beheer/materiaal">
	    <button class="btn btnreg btn-success btn-default">Materiaalbeheer</button>
	</a>
	<a href="/beheer/gebruikers">
	    <button class="btn btnreg btn-success btn-default">Studentenbeheer</button>
	</a>
</div>
<div>
	@if(!$messages->isEmpty())
		<h2>berichten</h2>
		<table>
			<tr>
				<th>title</th>
				<th>bericht</th>
				<th>status</th>
				<th>afzender</th>
				<th>naam van materiaal</th>
				<th>materiaal status</th>
			</tr>
			@foreach($messages as $message)
				<tr>
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
	@endif
</div>

@stop