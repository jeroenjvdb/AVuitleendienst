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
				{{$reservation->name}} is nog niet terugebracht. Gelieve dit zo snel magelijk te doen.
				<br/>
				Met vriendelijke groeten,
				<br/>
				KdG Uitleendienst
			</p>
		</div>
	</body>
</html>