@extends("global.base")

@section("page-title")
	Overzicht
@stop

@section("nav")
	@include("global.nav")
@stop

@section("content")
	<span><a href="/beheer">Beheer </a>> Gebruikers</span>
	<h2>Beheer Gebruikers</h2>
	<div>

	<div class="loginbox">    
		<a href="/users/create">
		    <button class="btn btnreg btn-success btn-default">Nieuwe gebruiker aanmaken</button>
		</a>
	</div>
	<br>

		@if(count($gebruikers) > 0)
			<table width="100%">
				<tr>
					<th>E-mail</th>
					<th>Voornaam</th>
					<th>Achternaam</th>
					<th>Account</th>
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
						<td>{{link_to('users/' . $gebruiker->id . '/edit','')}}<img src="../../assets/images/edit.png"></td>
						<td><img src="../../assets/images/delete.png"></td>
					</tr>
				@endforeach
			</table>
		@endif
	</div>
@stop