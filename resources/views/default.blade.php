@extends('layouts.master')
@section('content')
<section class="settings container">
  @if (session('status'))
      <div id="js-error" class="alert alert-success">
          {{ session('status') }}
          <a id="js-close">x</a>
      </div>
  @endif
  <div class="test">
    test
  </div>
</section>
@endsection
