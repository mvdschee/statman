<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="index, follow">

		<meta property="og:type" content="website">
		<meta property="og:url" content="https://monitool.nl/">
		<meta property="og:locale" content="nl_NL">
		<meta property="og:site_name" content="Monitool">
		<meta property="og:title" content="Monitool">
		<meta property="og:description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta property="og:image" content="https://monitool.nl/image.png">

		<meta name="description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta name="keywords" content="monitool,analytics,tracking,social media">
		<meta name="author" content="DataBoyz">

		<meta itemprop="name" content="Monitool">
		<meta itemprop="headline" content="Monitool">
		<meta itemprop="description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta itemprop="image" content="https://monitool.nl/image.png">

		<meta name="apple-mobile-web-app-title" content="Monitool">
		<meta name="application-name" content="Monitool">
		<meta name="theme-color" content="#000000">
		<link rel="shortcut icon" href="{{ URL::asset("/resources/assets/img/favicon.ico") }}">
		<title>Monitool</title>
		<link rel="stylesheet" href="{{ URL::asset("/resources/assets/css/app.css") }}">
	</head>
	<body onload="loadPage()" class="setup">

			<div class="login-container">
				<div id="js-progress" class="login-progress invisible">
					<figure class="login-image">Logo</figure>
					<ul class="login-list">
						<li>Create an overview of your Storyworld</li>
						<li>Track social media engagement</li>
						<li>Add projectmembers</li>
					</ul>
				</div>

				<div id="js-view" class="login-view">
					@yield('content')
				</div>
			</div>
		<script src={{ URL::asset("/resources/assets/js/app.js") }}></script>
	</body>
</html>
