@extends('layouts.master')
@section('content')
	<input type="hidden" name="_token" value="{{ Session::token() }}">
	<input type="hidden" name="_source" value="">
	<input type="hidden" name="_target" value="">
	<input type="hidden" name="_node" value="">

	<div class="canvas">
			@if ($message)
				<div class="message">
					{{ $message }}
				</div>
			@endif

		<div id="js-storyworld" class="storyworld">
		</div>

		@if (!$token)
			<div id="js-center">
				<h1 >Looks like you got nothing to show off yet!</h1>
				<p>Please go to the settings and connect a social media platform.</p>
			</div>
		@endif
	</div>

	{{-- JS assets --}}
		{{-- window.data = { "services": @foreach ($pageData as $w) "service_index": "{{ $w}}", @endforeach ]} --}}
	<script>
		window.data = { "services": [@foreach ($pageData as $w){"service_index": "{{ $w}}"}, @endforeach]};
	</script>

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
	<script type="text/javascript" src="{{ URL::asset("assets/js/lib/classtoggle.min.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/lib/jquery-3.2.1.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/dashboard.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/storyworld.js") }}"></script>
	<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/storyworld-temp.css") }}">
@endsection
