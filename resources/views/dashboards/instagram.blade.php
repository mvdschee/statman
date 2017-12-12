@extends('layouts.master')
@section('content')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<div class="panel">

{{ csrf_field() }}
@if(!empty($data))
    <h1>{{print $data}}</h1>
@endif
@if(!empty($profiles))
   <ul>
    @foreach($profiles as $profile)
      <li>{{$profile->id}} </li>
      <li>{{$profile->profile}} </li>
      <li>{{$profile->profileid}} </li>
      <li>{{decrypt($profile->token)}} </li>
    @endforeach
    </ul>
@endif

<button id="js-getdata">getdata</button>
</div>
<script>
        document.getElementById('js-getdata').onclick = function(){
           @if(!empty($string)){
             gettokenbypost('{{$string}}');

          }
          @endif
        };

        function gettokenbypost(code){
           window.location.href = "http://statman.dev/token/"+code;
        }

</script>
<script type="text/javascript" src="{{ URL::asset("assets/js/lib/jquery-3.2.1.js") }}"></script>
<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/connect.js") }}"></script>
@endsection
