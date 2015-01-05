<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Alle berichten van uitleendienst</h1>
		@foreach($messages as $message)
			<div class="col-md-12 well well-sm">
				<h2>{{{$message->title}}}</h2>
				<p>
					From: {{$message->users->lastname.' '.$message->users->firstname}}<br/>
					email: {{$message->users->email}}
				</p>
				<p>
					{{$message->message}}
				</p>
				<p>
					Materiaal: {{$message->materials->name}}
				</p>
			</div>
		@endforeach
	</body>
</html>