@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ URL::asset("assets/css/dashboards/second.nested.css") }}">
<div class="panel" id="page">
	<div class="legend-block">
		<legend><h1 style="cursor: pointer" id="button">Story Overview</h1></legend>
		<p>Select the story you want to work with.</p>
	</div>
    @if (session('check'))
    <div class="error">
    	{{ session('check') }}
    </div>
    @endif
	@if ($data)
	<div class="container-story">
		<div class="project-group">
			@foreach ($data as $data)
					<div class="project-item">
						<img src="https://images.pexels.com/photos/785544/pexels-photo-785544.jpeg?w=1260&h=750&dpr=2&auto=compress&cs=tinysrgb" alt="">
						<div class="info-block">
							<div class="information">
								<h4>{{ $data['project_name'] }}</h4>
								<p>Date</p>
							</div>
							<a href="/storysettings/{{ $data['project_id'] }}"><i class="cog"></i></a>
						</div>
					</div>
			@endforeach
			<a class="add-project-item" href='{{ url('/create-story') }}'>
				<div><i></i></div>
			</a>
		</div>
	</div>
	@else
		<h3 class="no-story">You have no stories yet, do you want to create a new one?</h3>
		<a class="button" href='{{ url('/create-story') }}'>Create a story</a>
		{{-- Todo: styling van link --}}
	@endif

	@if ($invites)
		<legend><h2 class="invite_header">Invites</h2></legend>
		<table class="storylist">
			<tr>
				<th class="tableheader add-button"></th>
				<th class="tableheader align-left">Project name</th>
			</tr>
			@foreach ($invites as $invite)
				<tr>
					<td class="add-button"><a href="/invited/{{ $invite['token'] }}"><i class='icon-plus'></i></a></td>
					<td>{{ $invite['project_name'] }}</td>
				</tr>
			@endforeach
		</table>
	@endif
</div>
<script type="text/javascript">
window.onload = function() {
	var button = document.getElementById('button');
	button.onclick = function(){
		var body = document.getElementById('page')
		if(body.classList == ""){
			body.classList = "spinnerino";
		} else {
			body.classList = "";
		}
	}

};
</script>

@endsection
