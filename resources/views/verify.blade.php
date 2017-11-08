@extends('layouts.master')
@section('content')
   <div class="top-bar">
      <h2>Verify your email</h2>
   </div>
   <div class="canvas">
      <div class="panel">
         @if (!empty($errors))
            @foreach($errors->all() as $message)
               <p class="error"> {{ $message }} </p>
            @endforeach
         @endif
         <p>In order to use this application we need for you to verify your email. </br>Check your email for the verification code.</p>
         <form role="form" method="POST" action="{{ route('verify') }}">
             {{ csrf_field() }}
             <div class="{{ $errors->has('token') ? ' has-error' : '' }}">
                <input id="token" type="text" name="token" placeholder="123456" required autofocus>
            </div>
            <button type="submit">submit</button>
         </form>
         @if (!empty($expire))
            <a href="/getnewtoken">Send me a new token!</a>
         @endif
      </div>
   </div>
@endsection
