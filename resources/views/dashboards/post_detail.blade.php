@extends('layouts.master')

@section('content')

<div class="container">
  <section class="centerblock">

      <div class="middle-new">
        <div class="elements">


          <div class="info-facebook">
            <div class="circle">
              <img src="{{ URL::asset("../assets/img/fb.svg") }}">
              <div class="titles">
                <h3>Aflevering reminder</h3>
                <p class="light">Coldfeet</p>
              </div>
            </div>
          </div>


          <div class="postcontent">
            <p>Out believe has request not how comfort evident. Up delight cousins we feeling minutes. Genius has looked end piqued spring. Down has rose feel find man. Learning day desirous informed expenses material returned six the. She enabled invited exposed him another. Reasonably conviction solicitude me mr at discretion reasonable. </p>
          </div>


          <div class="bottom-new">


            <div class="engagement">
              <h3>Engagement</h3>
              <ul>
                <li>
                  <img src="{{ URL::asset("../assets/img/like.svg") }}">
                  <p>143</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/comments.svg") }}">
                  <p>37</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/views.svg") }}">
                  <p>742</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/share.svg") }}">
                  <p>3</p>
                </li>
              </ul>
            </div>


            <div class="engagement negative">
              <h3>Negative feedback</h3>
              <ul>
                <li>
                  <img src="{{ URL::asset("../assets/img/dislike.svg") }}">
                  <p>89</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/comments.svg") }}">
                  <p>17</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/views.svg") }}">
                  <p>340</p>
                </li>
                <li>
                  <img src="{{ URL::asset("../assets/img/share.svg") }}">
                  <p>6</p>
                </li>
              </ul>
            </div>


            <div class="chart">

            </div>


          </div>

        </div>
      </div>

  </section>
</div>
@endsection
