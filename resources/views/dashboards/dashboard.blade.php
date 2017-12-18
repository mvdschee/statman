@extends('layouts.master')
@section('content')
	<input type="hidden" name="_token" value="{{ Session::token() }}">
	<input type="hidden" name="_source" value="">
	<input type="hidden" name="_target" value="">
	<input type="hidden" name="_node" value="">

		<div class="canvas">
			@if ($token)
				@if ($message)
					<div class="message">
						{{ $message }}
					</div>
				@endif

				<header class="header">
					{{-- Chapter --}}
					<button id="js-chapter" class="chapter">()</button>
					<button id="js-delete-chapter" class="delete-chapter">X</button>

					{{-- Refresh --}}
					<button id="js-refresh">-></button>
			</header>
			<svg id="js-storyworld" class="storyworld">
				<rect class="zoom-layer"></rect>
			</svg>
		</div>

	@else
		{{-- PLEASE REMOVE THIS SHIT --}}
		<div class="no-page">
			<h3>It seems like you have not connected any social media to your project!</h3>
			<small>To see your storyworld and data, you must first press the button below to connect your social media page to your story!</small>
			<a class="button" href="{{ url('/add-service/'.$project->id) }}">Connect social media</a>
		</div>
	@endif

	{{-- JS assets --}}
	<script type="text/javascript">
		(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/lib/d3.min.js") }}"></script>
	<script src={{ URL::asset("assets/js/lib/classtoggle.min.js") }}></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/lib/jquery-3.2.1.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/dashboard.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/storyworld.js") }}"></script>
	<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/storyworld-temp.css") }}">
@endsection
