@extends('layouts.login')

@section('content')
<div class="create-story invisible" id="create-story">
    <header>
        <span>Name your story</span>
    </header>

    <form method="POST" action="{{ url('/create-story') }}">
    {{ csrf_field() }}

        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="text" name="name" placeholder="Story name" required autofocus>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit">Create</button>
        <a href="/story-list">Skip creating story</a>
    </form>
</div>


@endsection
