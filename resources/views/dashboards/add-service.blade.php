@extends('layouts.master')
@section('content')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Spul van facebook -->
<div class="row">
	<div class="settings-container">
		<legend><h2>Connect social media</h2></legend>
	    <hr>
	    <div id="js-loggedin-info">
		    <span>Choose a page to connect to your story.</span>
		    <div class="page-list-container">
		    	<table id="pagelist">
		    	</table>
		    </div>
			<form id="js-page-form" method="POST" action="{{ url('/add-service/save-page') }}">
			    {{ csrf_field() }}
			    <input type="hidden" name="service_token" id='token_input'>
			    <input type="hidden" name="name" id='name_input'>
			    <input type="hidden" name="service_index" id='index_input'>
			    <input type="hidden" name="project_id" id='project_id' value='{{ $project_id }}'>
			</form>
	    </div>
		<button id="js-login-fb" onclick="login_fb()">Login with Facebook to show pages</button>
	</div>
</div>

<script type="text/javascript" src="{{ URL::asset("assets/js/lib/jquery-3.2.1.js") }}"></script>
<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/connect.js") }}"></script>
@endsection
