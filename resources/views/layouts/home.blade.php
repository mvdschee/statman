<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="index, follow">

		{{-- for social media --}}
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://statman.nl/">
		<meta property="og:locale" content="nl_NL">
		<meta property="og:site_name" content="Monitool">
		<meta property="og:title" content="Monitool">
		<meta property="og:description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta property="og:image" content="http://statman.nl/image.png">

		{{-- search engine descriptions --}}
		<meta name="description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta name="keywords" content="statman,analytics,tracking,social media">
		<meta name="author" content="DataBoyz">

		{{-- itemprops --}}
		<meta itemprop="name" content="Monitool">
		<meta itemprop="headline" content="Monitool">
		<meta itemprop="description" content="Monitool is a tool to track the behavior of your targeted audience and engagement throughout a selection of platforms.">
		<meta itemprop="image" content="http://statman.nl/image.png">

		{{-- mobile browser data --}}
		<meta name="apple-mobile-web-app-title" content="Monitool">
		<meta name="theme-color" content="#262d66">
		<link rel="apple-touch-icon" sizes="180x180" href="/public/apple-touch-icon.png">

		<meta name="application-name" content="Monitool">
		<meta name="msapplication-navbutton-color" content="#000000">

		{{-- favicons --}}
		<link rel="manifest" href="/public/manifest.json">
		<link rel="mask-icon" href="/public/safari-pinned-tab.svg" color="#262d66">
		<link rel="shortcut icon" href="{{ URL::asset("/resources/assets/img/favicon.ico") }}">

		<title>Monitool</title>
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
	</head>

	<body class="body">
		<header class="header">
			<h1 class="logo">Monitool</h1>
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
			<p>coded with <3 Databoyz.</p>
		</footer>
		<script src={{ URL::asset("/resources/assets/js/resources/particles.min.js") }}></script>
		<script src={{ URL::asset("/resources/assets/js/home.js") }}></script>
	</body>
</html>
