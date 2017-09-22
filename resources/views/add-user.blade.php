@extends('layouts.login')

@section('content')
<div class="create-story" id="add-user">
    <header>
        <span>Invite user to your project</span>
    </header>

    <form role="form" method="POST" action="{{ url('/add-user') }}">
    {{ csrf_field() }}
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
        <div class="{{ $errors->has('email') ? ' has-error' : '' }} group">
            <input id="email" type="text" name="email" placeholder="Invite colleagues with e-mail" required autofocus>
            
            <select name='role' class="role">
                <option selected disabled>Choose role</option>
                <option value='1'>Owner</option>
                <option value='2'>Writer</option>
                <option value='3'>Reader</option>
            </select>
        </div>
        <input type="hidden" value="{{ $project }}" name="project">
        <button type="submit">Invite</button>
    </form>
</div>

@endsection