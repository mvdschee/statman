@extends('layouts.home')
@section('content')
    @if ($message)
      <div class="message">
        {{ $message }}
      </div>
    @endif
    <section class="hero">
      <figure class="image right"><img src="{{ URL::asset("assets/img/workspace.svg") }}" alt="workspace"></figure>
      <article class="text left">
        <h2 itemprop="headline">The way you see your story, that is what we care about.</h2>
        <p>We know from experience that it is important to have a clear overview of the impact your story has with your target audience.</p>
        <div class="buttons">
          @if (Route::has('login'))
            @unless(Auth::check())
              {{-- <a class="button" href="{{ url('/register') }}">Sign me up!</a> --}}
            @endunless
          @endif
        </div>
      </article>
    </section>

    <section class="social clear">
      <ul class="social-group">
        <li class="social-item"><img src="{{ URL::asset("assets/img/instagram.svg") }}" alt="instagram"></li>
        <li class="social-item"><img src="{{ URL::asset("assets/img/facebook.svg") }}" alt="facebook"></li>
        <li class="social-item"><img src="{{ URL::asset("assets/img/you-tube.svg") }}" alt="youtube"></li>
        <li class="social-item"><img src="{{ URL::asset("assets/img/twitter.svg") }}" alt="twitter"></li>
      </ul>
      <article class="social-content">
        <h1>Social media platforms</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we made Statman. The tool allows you to track your story on multiple platforms.</p>
      </article>
    </section>

    <section class="storyworld clear">
      <figure class="storyworld-image left">
        <img src="{{ URL::asset("assets/img/group-4.png") }}" alt="workspace">
      </figure>
      <article class="storyworld-text right">
        <h1>The Storyworld</h1>
        <p>The Storyworld is a multi-functional web tool to create insight in the engagement of your story, it’s main focus is to allow cross-platform tracking, a new way of tracking your story’s succes rate.</p>
      </article>
    </section>

    <section class="security clear">
      <ul class="security-group">
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("assets/img/small-server.png") }}" alt="server">
          </figure>
          <h2>Security</h2>
          <p>We know you make amazing stories and we make sure to store it securely so it won't leak beforehand.</p>
        </li>
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("assets/img/middle-server.png") }}" alt="server">
          </figure>
          <h2>Your privacy, your control</h2>
          <p>With Statman you have complete control of your content. Your privacy is not for sale, that's something we totally understand.</p>
        </li>
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("assets/img/big-server.png") }}" alt="server">
          </figure>
          <h2>Identity Protection</h2>
          <p>We care about your privacy, the data we store is unrecognizable and stored within the EU. If intruders would get through our security the stored data would not be usable in any way.</p>
        </li>
      </ul>
    </section>

    <section class="call-to-action clear">
      <figure class="call-to-action-image left">
        <img src="{{ URL::asset("assets/img/balloon.svg") }}" alt="balloon">
      </figure>
      <article class="call-to-action-text right">
        <h1>Get started today!</h1>
        <p>Make an account now and start conquering!</p>
        @if (Route::has('login'))
          @unless(Auth::check())
            {{-- <a class="button" href="{{ url('/register') }}">Sign me up!</a> --}}
          @endunless
        @endif
      </article>
    </section>

@endsection
