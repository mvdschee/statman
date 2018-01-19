@extends('layouts.master')
@section('content')

<section class="hero">
	<div class="hero-content">
		<span class="hero-icon" style="background-image: url({{ URL::asset("assets/img/Storyworld-Title-Icon.svg") }});"></span>
		<span>
			<h1>STORY OVERVIEW</h1>
			<p>Select the story you want to work with.</p>
		</span>
	</div>
</section>

@if (session('check'))
	<div class="error">
		{{ session('check') }}
	</div>
@endif

<section class="stories">
	<div class="stories-group">
		@if ($data)
			@foreach ($data as $data)
				<div class="stories-item">
					<a class="stories-image" href="/dashboard/{{ $data['project_id'] }}" style="background-image: url({{ URL::asset("assets/img/group-4.png") }});">
					</a>
					<div class="item-footer">
						<span class="left">
							<h4>{{ $data['project_name'] }}</h4>
							<p>19 jan 2018</p>
						</span>
						<a class="right" href="/storysettings/{{ $data['project_id'] }}"></a>
					</div>
				</div>
			@endforeach
			<a class="stories-item add" href='{{ url('/create-story') }}'></a>
		@else
			<a class="stories-item add" href='{{ url('/create-story') }}'></a>
		@endif
	</div>
</section>

{{-- Who wrote this and what does it do? --}}
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

@endsection
