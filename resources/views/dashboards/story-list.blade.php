@extends('layouts.master')
@section('content')

<div class="panel">
	<legend><h2>Stories</h2></legend>
    @if (session('check'))
    <div class="error">
    	{{ session('check') }}
    </div>
    @endif
	@if ($data)
		<table class="storylist">
			<tr class="tableheader">
				<th>Project</th>
				<th>Role</th>
				<th class="options-td">Invite</th>
			</tr>
			@foreach ($data as $data)
				<tr>
					<td>
						<form method="POST" action="{{ url('/story-list/favorite') }}">
							{{ csrf_field() }}
							<input type="hidden" name="project" value="{{ $data['project_id'] }}">
							@if ($user->favorite == $data['project_id'])
								<button class="unfavorite icon-star"></button>
							@else
								<button class="favorite icon-star-o"></button>
							@endif
						</form>
						<a href="{{ url('/dashboard/') }}/{{ $data['project_id'] }}" class="project_name">{{ $data['project_name'] }}</a>
					</td>
					<td class="role-name">{{ $data['role'] }}</td>
					<td class="options-td">
						<form method="POST" action="{{ url('/story-list') }}">
							{{ csrf_field() }}
							<input type="hidden" name="option" value="{{ $data['project_id'] }}">
							<a href="/storysettings/{{ $data['project_id'] }}">settings</a>
							<button type="submit"><i class='icon-user-add'></i></button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
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
					<td class="add-button">
						<a href="/invited/{{ $invite['token'] }}"><i class='icon-plus'></i></a>
					</td>
					<td>{{ $invite['project_name'] }}</td>
				</tr>
			@endforeach
		</table>
	@endif
</div>

@endsection
