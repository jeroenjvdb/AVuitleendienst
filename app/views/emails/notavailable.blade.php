<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			<p>
				Beste {{$reservation->lastname.' '.$reservation->firstname}}
				<br/>
				<br/>
				{{$reservation->name}} is nog niet beschikbaar.
				
			</p>
		</div>
	</body>
</html>