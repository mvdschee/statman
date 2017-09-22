@extends('layouts.master')
@section('content')
	<input type="hidden" name="_token" value="{{ Session::token() }}">
	@if ($token)
		@if ($message)
			<div class="message">
				{{ $message }}
			</div>
		@endif
		<div class="top-bar">
			<button id="js-new-heading">New chapter</button>
			@if ($access->role_index_id == 1)
			<form action="/dashboard/delete-page" method="POST" onsubmit="return confirm('Are you sure you want to delete your story? This cannot be reversed.');">
				{{ csrf_field() }}
				<input type="hidden" name="project" value="{{ $project->id }}">
				<button type="submit" id="js-delete-story">Delete story</button>
			</form>
			@endif
		</div>
		<div class="canvas">
			<svg id="js-story-world" viewBox="-500 -500 1000 1000">
				<rect class="zoom-layer"></rect>
			</svg>
		</div>
		@foreach ($pageData as $pageData)
			<div id="posts">
				<div class="post title">
					<div class="line"></div>
					<div class="content">
						Recent Posts
					</div>
				</div>
				<div class="spinner">
				  <div class="double-bounce1"></div>
				  <div class="double-bounce2"></div>
				  <h3>Loading posts...</h3>
				</div>
			</div>
		@endforeach
	@else
		<div class="no-page">
			<h3>It seems like you have not connected any social media to your project!</h3>
			<small>To see your storyworld and data, you must first press the button below to connect your social media page to your story!</small>
			<a class="button" href="{{ url('/add-service/'.$project->id) }}">Connect social media</a>
		</div>
	@endif
	<script type="text/javascript" src="{{ URL::asset("/resources/assets/js/d3.min.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("/resources/assets/js/jquery-3.2.1.js") }}"></script>
	<script type="text/javascript" src="{{ URL::asset("/resources/assets/js/dashboard.js") }}"></script>

@endsection
