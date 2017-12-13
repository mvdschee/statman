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
		<meta property="og:locale" content="en_US">
		<meta property="og:site_name" content="Statman">
		<meta property="og:title" content="Statman">
		<meta property="og:description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed Statman. The tool allows you to track your story on multiple platforms.">
		<meta property="og:image" content="{{ URL::asset("assets/img/statman.svg") }}">
		<meta name="description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed Statman. The tool allows you to track your story on multiple platforms.">
		<meta name="keywords" content="statman,analytics,tracking,social media,facebook,storyworld,yumyum,managing,engage">
		<meta name="author" content="YumYum">
		<meta itemprop="name" content="Statman">
		<meta itemprop="headline" content="Statman">
		<meta itemprop="description" content="Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed Statman. The tool allows you to track your story on multiple platforms.">
		<meta itemprop="image" content="{{ URL::asset("assets/img/statman.svg") }}">
		<link rel="shortcut icon" href="{{ URL::asset("assets/img/statman-line.svg") }}">
		<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/app.css") }}">

		<title>Statman | Login</title>

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
	<body onload="loadPage()" class="setup">
				<div id="js-view" class="login-view">
					@yield('content')
				</div>
		<script src={{ URL::asset("assets/js/dashboards/app.js") }}></script>
	</body>
</html>
