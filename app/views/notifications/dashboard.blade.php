@extends('global.base')

@section('page-title')
dashboard
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')

	@foreach($notifications as $notification)
	<div class="col-md-10">
		<p>{{ $notification->message }}</p>
	</div>
	<div class="col-md-2">
		@if(Auth::user() && Auth::user()->type == "admin")
			<a href="{{ route('notifications.edit', ['id' => $notification->id]) }}">edit</a>
		@endif
	</div>
	@endforeach
@stop