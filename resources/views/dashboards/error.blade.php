@extends('layouts.master')
@section('content')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


{{ csrf_field() }}
@if(!empty($data)){
    {{dd($data)}}
}
@endif

<script type="text/javascript" src="{{ URL::asset("assets/js/lib/jquery-3.2.1.js") }}"></script>
<script type="text/javascript" src="{{ URL::asset("assets/js/dashboards/connect.js") }}"></script>
@endsection
