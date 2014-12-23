@extends("global.base")

@section("page-title")
	Welkom
@stop

@section("content")

<h1>Oeps...</h1>
<p>{{$message}}</p>
{{link_to($url,'Back')}}

@stop