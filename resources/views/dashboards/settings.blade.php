@extends('layouts.master')
@section('content')
<section class="settings container">

    @if (session('status'))
        <div id="js-error" class="alert alert-success">
            {{ session('status') }}
            <a id="js-close">x</a>
        </div>
    @endif

    <div class="settings-container">
        <div class="general-header">
            <img  class="picture" src="{{ Gravatar::get( Session::get( 'email'), ['secure' => true, 'size'=>250] )  }}" alt="test">
            <div class="text">
                <h2 class="name" >{{ $Name }}</h2>
                <p>{{ $SessionMail }}</p>
                <p>Avatar provided by <a href="https://secure.gravatar.com/" target="_blank" rel="noreferrer noopener">gravatar.com</a></p>
            </div>
        </div>
        <form method="POST" action="{{ url('/settings') }}" class="password">
            <legend><h2>Account</h2></legend>
            <hr>
            <div class="name clear">
                <span class="left">
                    <h4>Full name</h4>
                </span>
                <span class="right">
                    <input type="text" name="fullname" value="" placeholder="{{ $Name }}">
                </span>
            </div>
            <div class="email clear">
                <span class="left">
                    <h4>Email</h4>
                </span>
                <span class="right">
                    <input type="text" name="email" value="" disabled="disabled" placeholder="{{ $SessionMail }}">
                </span>
            </div>
            <div class="password clear">
                {{ csrf_field() }}
                <span class="left">
                    <h4>Password</h4>
                </span>
                <span class="right">
                    <input type="password" name="current_password" value="" placeholder="Enter your current password">
                    <input type="password" name="password" value="" placeholder="Enter your new password">
                    <input type="password" name="password_confirmation" value="" placeholder="Re-enter your new password">
                    <button type="submit">Update</button>
                </span>
            </div>
        </form>
    </div>

</section>
@endsection
