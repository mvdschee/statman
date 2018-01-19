<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="apple-mobile-web-app-title" content="Statman">
		<meta name="application-name" content="Statman">
		<meta name="theme-color" content="#000000">
		<link rel="shortcut icon" href="{{ URL::asset("assets/img/statman-line.svg") }}">
		<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/styles.css") }}">
		<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/app.css") }}">
		<title>Statman | Dashboard</title>
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

	<body class="body {{Route::currentRouteName()}}" >
		@if (Auth::check())
			<header class="header">

				<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="logout icon-sign-out">Log out</a>
				<a class="settings icon-cog" href="{{ url('/settings') }}">Settings</a>
				@if (Route::currentRouteName() == 'dashboard')
					@if ($token)
						{{-- Chapter --}}
						<button id="js-chapter" class="chapter">Add Chapter</button>
						<button id="js-delete-chapter" class="delete-chapter">Delete Chapter</button>

						{{-- Refresh --}}
						<button id="js-refresh">Refresh</button>
					@endif
					<a href="/story-list"><button class="chapter">Go Back</button></a>
				@endif

				{{-- TEMP buttons --}}
				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</header>
		@endif

		<div class="main clear">
			@yield('content')
		</div>
		<script src={{ URL::asset("assets/js/dashboards/app.js") }}></script>
	</body>
</html>
