@extends('layouts.home')
@section('content')
    <section class="hero">
      <article class="text left">
        <h2 itemprop="headline">The way you see your story, that is what we care about.</h2>
        <p>We know from experience that it is important to have a clear overview of the impact your story has with your target audience.</p>
        <div class="buttons">
          @if (Route::has('login'))
            @unless(Auth::check())
              <a class="button" href="{{ url('/register') }}">Sign me up!</a>
            @endunless
          @endif
          <a class="button" href="#">Let's see how</a>
        </div>
      </article>
      <figure class="image right"><img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace"></figure>
    </section>

    <section class="social clear">
      <ul class="social-group">
        <li class="social-item"><img src="{{ URL::asset("/resources/assets/img/instagram.svg") }}" alt="instagram"></li>
        <li class="social-item"><img src="{{ URL::asset("/resources/assets/img/facebook.svg") }}" alt="facebook"></li>
        <li class="social-item"><img src="{{ URL::asset("/resources/assets/img/you-tube.svg") }}" alt="youtube"></li>
        <li class="social-item"><img src="{{ URL::asset("/resources/assets/img/twitter.svg") }}" alt="twitter"></li>
      </ul>
      <article class="social-content">
        <h1>Social media platforms</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on.</p>
      </article>
    </section>

    <section class="storyworld clear">
      <figure class="storyworld-image left">
        <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
      </figure>
      <article class="storyworld-text right">
        <h1>The Storyworld</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on.</p>
      </article>
    </section>

    <section class="security clear">
      <ul class="security-group">
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("/resources/assets/img/small-server.png") }}" alt="server">
          </figure>
          <h2>Security of data</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("/resources/assets/img/middle-server.png") }}" alt="server">
          </figure>
          <h2>Security of data</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
        <li class="security-item">
          <figure>
            <img src="{{ URL::asset("/resources/assets/img/big-server.png") }}" alt="server">
          </figure>
          <h2>Security of data</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
      </ul>
    </section>

    <section class="endorsment clear">
      <figure class="endorsment-image left">
        <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
      </figure>
      <article class="endorsment-text right">
        <h1>Affiliates & endorsements</h1>
        <p>Ofcourse we can’t expect you to take our word on the quality of our product, instead we recommend you to ask our affiliated companies or read their in-depth reviews.</p>
      </article>
    </section>



@endsection
