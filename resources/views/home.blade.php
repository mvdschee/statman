@extends('layouts.home')
@section('content')
    <section class="hero">
      <article class="text left">
        <h2 itemprop="headline">The way you see your story, that is what we care about.</h2>
        <p>We know from experience that it is important to have a clear overview of the impact your story has with your target audience.</p>
        <a class="button" href="#">Let's see how</a>
      </article>
      <figure class="image right"><img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace"></figure>
    </section>

    <section class="features clear">
      <ul class="features-group">
        <li class="features-item">facebook</li>
        <li class="features-item">facebook</li>
        <li class="features-item">facebook</li>
        <li class="features-item">facebook</li>
      </ul>
      <article class="features-content">
        <h1>Social media platforms</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on.</p>
      </article>
    </section>

    <section class="storyworld clear">
      <figure class="storyworld-image left">
        <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
      </figure>
      <article class="storyworld-text right">
        <h1>Social media platforms</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on.</p>
      </article>
    </section>

    <section class="security clear">
      <ul class="security-group">
        <li class="security-item">
          <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
          <h2>security</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
        <li class="security-item">
          <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
          <h2>security</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
        <li class="security-item">
          <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
          <h2>security</h2>
          <p>I close the curtains and fall back on my bed, covering my face with my pillow, but the smell becomes stronger and stronger. “Damn Skunk!”</p>
        </li>
      </ul>
    </section>

    <section class="endorsment clear">
      <figure class="endorsment-image left">
        <img src="{{ URL::asset("/resources/assets/img/workspace.svg") }}" alt="workspace">
      </figure>
      <article class="endorsment-text right">
        <h1>Social media platforms</h1>
        <p>Tracking and managing your story can be challenging, in order to help you engage with your story on a deeper level we developed a tool. The tool allows you to track your story on.</p>
      </article>
    </section>



@endsection
