<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="index, follow">
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://statman.nl/">
		<meta property="og:locale" content="nl_NL">
		<meta property="og:site_name" content="Statman">
		<meta property="og:title" content="Statman">
		<meta property="og:description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on multiple platforms.">
		<meta property="og:image" content="https://statman.nl/image.png">
		<meta name="description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on multiple platforms.">
		<meta name="keywords" content="statman,analytics,tracking,social media">
		<meta name="author" content="YumYum">
		<meta itemprop="name" content="Statman">
		<meta itemprop="headline" content="Statman">
		<meta itemprop="description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on multiple platforms.">
		<meta itemprop="image" content="https://statman.nl/image.png">

		<title>Statman | Home</title>

		<link rel="stylesheet" href="{{ URL::asset("/resources/assets/css/home.css") }}">

		<script type="text/javascript">
			var _paq = _paq || [];
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
				var u="https://analytics.ewake.nl/";
				_paq.push(['setTrackerUrl', u+'piwik.php']);
				_paq.push(['setSiteId', '6']);
				var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
				g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
			})();
		</script>
		<noscript><p><img src="https://analytics.ewake.nl/piwik.php?idsite=6&rec=1" style="border:0;" alt="" /></p></noscript>
	</head>

	<body class="body">
		<header class="header">
			<h1 class="logo">Statman</h1>
			@if (Route::has('login'))
				<nav class="navigation">
					@if (Auth::check())
						<a href="{{ url('/story-list') }}">Dashboard</a>
					@else
						<a href="{{ url('/login') }}">Login</a>
						<a href="{{ url('/register') }}">Register</a>
					@endif
				</nav>
			@endif
		</header>
		<section class="main">
			@yield('content')
		</section>
		<footer class="footer">
			<p>coded with <3 YumYum.</p>
		</footer>
		<script src={{ URL::asset("/resources/assets/js/resources/particles.min.js") }}></script>
		<script src={{ URL::asset("/resources/assets/js/home.js") }}></script>
	</body>
</html>
