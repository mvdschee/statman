@extends('layouts.login')

@section('content')
<!-- REGISTER FORM -->
<div class="form">
    <div id="register" class="register invisible">
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span>
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <input id="password-confirm" type="password" placeholder="Confirm password" name="password_confirmation" required>
            </div>
            <span class="buttons">
                <button type="submit">
                    Register
                </button>
            </span>
        </form>
    </div>

    <div class="testtest">
      hoi
    </div>

    <!-- LOGIN FORM -->
    <div id="login" class="login invisible">
        <form id="login" class="" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="text" name="email" placeholder="E-mail" required autofocus>
            </div>
            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <label for="remember" class="remember">
                <input type="checkbox" name="remember" id="remember">
                Remember Me?
            </label>
            <span class="buttons">
                <button type="submit">Login</button>
                <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
            </span>
        </form>
    </div>
</div>
@endsection
