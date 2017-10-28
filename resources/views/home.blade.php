@extends('layouts.home')
@section('content')
    <section id="particles-js" class="hero">
        <div class="hero-text">
            <h2>Statman</h2>
            <h3>Not just a tool, the way to create.</h3>
        </div>
    </section>
    <section class="features">
        <div class="error">
            <p>{{ $message }}</p>
        </div>
        <div class="features-group">

            <div class="features-item">
                <img class="features-image" src="{{ secure_asset("/resources/assets/img/storyworld.jpg") }}" alt="">
                <h3>Storyworld</h3>
                <p>We understand you don't want just your boring old datasheets, you want a great way to visualise the story throughout multiple sociale media platforms.</p>
            </div>

            <div class="features-item">
                <img class="features-image" src="{{ secure_asset("/resources/assets/img/smartphone.jpg") }}" alt="">
                <h3>Social Media</h3>
                <p>By combining more than one social media platform you have the ability to cross-reference what works best for your story.</p>
            </div>

            <div class="features-item">
                <img class="features-image" src="{{ secure_asset("/resources/assets/img/security.jpg") }}" alt="">
                <h3>Security</h3>
                <p>We truly understand the importance of your story to stay private until you want it to be shared. So, we took the liberty to just encrypt the crap out of everything and, of course, to make sure nobody can access your story.</p>
            </div>
        </div>
    </section>
    <section class="promo">
      <figure class="image" style="background-image: url({{ secure_asset("/resources/assets/img/promo.jpg") }});">
      </figure>
      <article class="text">
        <h1>This could be your story</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <br>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <a class="button" href="{{ url('/register') }}">Register</a>
      </article>
    </section>
    <section class="team">
      <figure class="image" style="background-image: url({{ secure_asset("/resources/assets/img/athletes.jpg") }});">
      </figure>
      <article class="text">
        <h1>The team behind it</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <br>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </article>
    </section>
@endsection
