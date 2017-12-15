@extends('layouts.login')

@section('content')

  <div class="container">
    <section class="window">
        <div class="top">
          <div class="inner-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="304 392 88 176" class="svg-icon">
              <g transform="translate(-2893 -1800)">
                <g id="guy"><path id="Path_1" data-name="Path 1" class="cls-1" d="M36 0A36 36 0 1 1 0 36 36 36 0 0 1 36 0z" transform="translate(3205 2192)"/>
                  <path d="M19 96A19 19 0 0 1 0 77V47.484C0 21.259 19.7 0 44 0s44 21.259 44 47.484V77a19 19 0 0 1-19 19z" transform="translate(3197 2272)"/>
                </g>
              </g>
            </svg>
            <h2>Log into Statman</h2>
          </div>
        </div>

        <div class="middle">

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
              </span>
          </form>
        </div>

        <div class="bottom">
          <a href="#">Don't have an account? Create one here</a>
          <a href="{{ url('/password/reset') }}">Forgot your password?</a>
        </div>
    </section>
</div>
@endsection
