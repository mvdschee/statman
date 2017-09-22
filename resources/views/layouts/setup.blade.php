<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="apple-mobile-web-app-title" content="Monitool">
		<meta name="application-name" content="Monitool">
		<meta name="theme-color" content="#000000">
		<link rel="shortcut icon" href="{{ URL::asset("/resources/assets/img/favicon.ico") }}">
		<title>Monitool</title>
		<link rel="stylesheet" href="{{ URL::asset("/resources/assets/css/app.css") }}">
	</head>
	<body onload="loadPage()" class="setup">
			<div class="container">
				@yield('content')
			</div>
		<script src={{ URL::asset("/resources/assets/js/app.js") }}></script>
	</body>
</html>
