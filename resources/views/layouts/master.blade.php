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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
					$(document).ready(function()
			{
				$("#menubutton").click(function(){
					if($("#menu").hasClass("open")){
						$("#menu").toggleClass("open", false);
						$("#menu").toggleClass("closed", true);
					} else {
						$("#menu").toggleClass("open", true);
						$("#menu").toggleClass("closed", false);
					}
				});
			});
		</script>
		<noscript><p><img src="https://analytics.ewake.nl/piwik.php?idsite=6&rec=1" style="border:0;" alt="" /></p></noscript>
	</head>

	<body class="body {{Route::currentRouteName()}}" >
		@if (Auth::check())
			<header class="header">

				<nav class="menu" id="menu">
				  <img id="menubutton"src="https://pbs.twimg.com/profile_images/944003679031627777/dvVdOta2_400x400.jpg">
				  <ul>
				    <li class="item">
							<a class="settings icon-cog but" href="{{ url('/settings') }}">Settings</a>
						</li>
				    <li class="item">

						</li>
						<li class="item">

						</li>
				    <li class="item">
							<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="logout but icon-sign-out">Log out</a>
						</li>
					</ul>



				@if (Route::currentRouteName() == 'dashboard')
					<a class="but chapter" href="/story-list">Go Back</a>
					@if ($token)
						{{-- Chapter --}}
						<button id="js-chapter" class="but chapter">Add Chapter</button>
						<button id="js-delete-chapter" class="but delete-chapter">Delete Chapter</button>

						{{-- Refresh --}}
						<button class="but" id="js-refresh">Refresh</button>
					@endif
				@endif

				{{-- TEMP but --}}
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
