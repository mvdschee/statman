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
            <form id="login" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
              @endif

              <div class="{{ $errors->has('email') ? ' has-error' : '' }} middle-block">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="304 392 88 176" class="svg-icon-small">
                    <g transform="translate(-2893 -1800)">
                      <g id="guy"><path id="Path_1" data-name="Path 1" class="cls-1" d="M36 0A36 36 0 1 1 0 36 36 36 0 0 1 36 0z" transform="translate(3205 2192)"/>
                        <path d="M19 96A19 19 0 0 1 0 77V47.484C0 21.259 19.7 0 44 0s44 21.259 44 47.484V77a19 19 0 0 1-19 19z" transform="translate(3197 2272)"/>
                      </g>
                    </g>
                  </svg>
                  <div class="form-style">
                    <input id="email" type="text" name="email" placeholder="E-mail" required autofocus>
                </div>
              </div>

              <div class="{{ $errors->has('password') ? ' has-error' : '' }} middle-block">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="svg-icon-small">
                    <use xlink:href="#path0_fill"/>
                    <use xlink:href="#path1_fill"/>
                    <defs>
                      <path id="path0_fill" fill-rule="evenodd" d="M12 13V6a3 3 0 1 0-6 0v7a3 3 0 1 0 6 0zM9 0a6 6 0 0 0-6 6v7a6 6 0 0 0 12 0V6a6 6 0 0 0-6-6z"/>
                      <path id="path1_fill" d="M0 14a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v7a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4v-7z"/>
                    </defs>
                </svg>
                <div class="form-style">
                  <input id="password" type="password" name="password" placeholder="Password" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <span class="buttons">
                <button type="button" class="btn">Cancel</button>
                <button type="submit" class="btn">Log me in</button>
              </span>

              <div class="checkbox">
                <span class="checkbox-block">
                  <input type="checkbox" id="checkbox" />
                  <label for="checkbox"><p>Remember me</p></label>
                </span>
            </div>

          </form>
        </div>

        <div class="bottom">
          <span class="bottom-block">
            <a href="{{ URL::asset('/register')}}">Don't have an account? Create one here</a>
          </span>
          <span class="bottom-element">
            <a href="{{ url('/password/reset') }}">Forgot your password?</a>
          </span>
        </div>
    </section>
</div>
@endsection
