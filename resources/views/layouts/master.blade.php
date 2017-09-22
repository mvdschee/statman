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
		<link rel="stylesheet" href="{{ URL::asset("/resources/assets/css/styles.css") }}">
		<link rel="stylesheet" href="{{ URL::asset("/resources/assets/css/app.css") }}">
	</head>

	<body class="body" >
		<header class="header">
			<span class="outer-space">

			</span>
			<h1 class="project-title"></h1>
		</header>

		<section class="sidebar">
			@if (Auth::check())
				<div class="profile">
					<a href="{{ url('/settings') }}"><img  class="profile-picture" src="{{ Gravatar::get( Session::get( 'email' ), ['secure' => true, 'size'=>350] ) }}" alt="test"></a>
					<h3 class="profile-name">{{ decrypt(Auth::user()->name) }}</h3>
					<div class="profile-options">
						<div class="logout">
							<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="icon-sign-out"></a>
							<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
						</div>

						<div class="settings">
							<a href="{{ url('/settings') }}" class="icon-cog"></a>
							<a href="{{ url('/settings') }}">Settings</a>
						</div>

					</div>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			@endif

			<nav class="navigation">
				<ul class="navigation-group">
					@if(Auth::user()->favorite)
						<li class="navigation-item">
							<a href="{{ url('/dashboard') }}/{{ Auth::user()->favorite }}">Favorite story</a>
						</li>
					@endif
					<li class="navigation-item"><a href="{{ url('/story-list') }}">Story list</a></li>
					<li class="navigation-item"><a href="{{ url('/create-story') }}">Create Story</a></li>
				</ul>
			</nav>
		</section>

		<div class="main">
			@yield('content')
		</div>

		{{-- PLEASE GOD, FIX MY JAVASCRIPT --}}
		<script src={{ URL::asset("/resources/assets/js/app.js") }}></script>
	</body>
</html>
