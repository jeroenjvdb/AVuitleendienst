@extends('global.base')

@section('page-title')
dashboard
@stop

@section("nav")
	@include("global.nav")
@stop

@section('content')
	@foreach($notifications as $notification)
		<p>{{ $notification->message }}</p>
	@endforeach
@stop