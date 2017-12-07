@extends('layouts.master')
@section('content')
	<input type="hidden" name="_token" value="{{ Session::token() }}">
	@if ($token)
		@if ($message)
			<div class="message">
				{{ $message }}
			</div>
		@endif
		<header class="top-bar">
			<button id="js-new-link" class="trigger_2">Link post</button>
			<div id="js-link-fields" class="execute_2 link-fields">
				<button id="js-save-link">Save</button>
			</div>
			<button id="js-chapter" class="chapter">Add Chapter</button>
			<div id="chapter-input">
				<input id="js-chapter-title" type="text" name="_chapter" value="">
				<button id="js-save-chapter">Save</button>
			</div>
			<button id="js-refresh">Fetch new data</button>
			@if ($access->role_index_id == 1)
			<form action="/dashboard/delete-page" method="POST" onsubmit="return confirm('Are you sure you want to delete your story? This cannot be reversed.');">
				{{ csrf_field() }}
				<input type="hidden" name="project" value="{{ $project->id }}">
				<button type="submit" id="js-delete-story">Delete story</button>
			</form>
			@endif
		</header>
		<div class="canvas">
			<svg id="js-storyworld" class="storyworld" width="920" height="600">
				<rect class="zoom-layer"></rect>
			</svg>
		</div>
	@else
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

@endsection
