@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer</a>>Gebruikers</span>
	<h2>Beheer Gebruikers</h2>
	<div>
		{{link_to('users/create', 'Nieuwe gebruiker aanmaken')}}
		@if(count($gebruikers) > 0)
			<table>
				<tr>
					<th>E-mail</th>
					<th>Voornaam</th>
					<th>Achternaam</th>
					<th>Type account</th>
					<th>Bewerken</th>
					<th>Verwijderen</th>
				</tr>
				@foreach ($gebruikers as $gebruiker)
					<tr>
						<td>{{{$gebruiker->email}}}</td>
						<td>{{{$gebruiker->firstname}}}</td>
						<td>{{{$gebruiker->lastname}}}</td>
						@if($gebruiker->type == "teacher")
							<td>Leerkracht</td>
						@elseif($gebruiker->type == "monitor")
							<td>Monitor</td>
						@elseif($gebruiker->type == "student")
							<td>Student</td>
						@else
							<td>Admin</td>
						@endif
						<td>{{link_to('users/' . $gebruiker->id . '/edit', 'Bewerken')}}</td>
						<td>DELETE</td>
					</tr>
				@endforeach
			</table>
		@endif
	</div>
@stop