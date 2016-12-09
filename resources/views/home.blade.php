@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row slider">
        <div class="col-md-12 nopadding">
            <img src="./public/img/slider1.png" class="img-responsive">
            <div class="content text-center">
                <div class="col-md-12">
                    <h2 class="customh2">Everything you need</h2>
                    <span class="large-text">In one place</span>
                    <a href="/monitool-repo/dashboard" class="button">Start using Monitool!</a>
                </div>
                
            </div>
           
        </div>

    </div>
    <div class="row icons">
      <div class="col-md-4 ">
        <div class="title">Create a project</div>
        <div class="description"> It’s easy to make an account and to add a project to it</div>
        <img src="./public/icons/1.png" class="icon">
      </div>
        <div class="col-md-4 ">
            <div class="title">Add your social media</div>
            <div class="description">In a few simple steps you can add your social media</div>
            <img src="./public/icons/2.png" class="icon">
          </div>
        <div class="col-md-4 ">
            <div class="title">See your progress</div>
            <div class="description">
            Now you can add filters and see how your project is doing
            </div>
            <img src="./public/icons/3.png" class="icon">
        </div>
    </div>

    <div class="row text-center smallheader"></div>

    <div class="row text-center">
        <h2 class="customh2"><span>One tool to monitor all your transmedia projects</span></h2>
        <hr class="divider horizontal-break small">
    </div>

    <div class="row text-center">
        <div class="col-md-12 contentblock1">
         <p>
         Tired of having to keep switching between bookmarks and tabs just to see 
how many likes you’ve got? With Monitool you have a simple and intuitive
 overview in which you can connect to your target audience and know 
where your project is heading.
         </p>
        </div>
    </div>

    <div class="row text-center">
        <h2 class="customh2 line">The best free way to improve your reach</h2>
        <hr class="divider horizontal-break small">
    </div>

    <div class="row text-center ">
        <div class="col-md-12 contentblock2">
             <p>
             With Monitool you can easily see where your content is most watched and 
by who.  You can improve your reach by following your populairity and reacting
 to changes in your target audience.
             </p>
        </div>
    </div>

  <div class="row footer">
    <div class="col-md-12 text-center">
      <a href="">Copyright Monitool</a>
      </div>
    </div>
  </div>
</div>

@endsection
