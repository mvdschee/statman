@extends('layouts.dashboard')
@section('content')
<?php 
use App\Project;
$id = Auth::id();
$project = Project::find($id);
 ?>
<h1>{{ $project->name }}</h1>
<div style="padding-bottom:250px;"></div>
<div class="container">
  <div class="row mediachannels text-center">
    <div class="col-md-4">
      <div style="border: 1px solid black";>
        <h3>Facebook</h3>
        <br>hier meer facebook data<br>
          <div style="width: 200px;
                height: 80px;
                margin-left: 80px;
                margin-top: 20px;
                background-color: #eee;
                overflow: auto;">Hier heeeeeeeeeeel veeel tekst dat onzinning is voor de overlfow wat je weet zelf G vat het niet personal man
          </div>
        </div>
      </div>    
    <div class="col-md-4">
    <h3>Youtube</h3>
    <br>hier meer Youtube data<br>
     <div style="width: 200px;
                height: 80px;
                margin-left: 80px;
                margin-top: 20px;
                background-color: #eee;
                overflow: auto;">
                Hier heeeeeeeeeeel veeel tekst dat onzinning is voor de overlfow wat je weet zelf G vat het niet 
                personal man
      </div>
    </div>
    <div class="col-md-4">
    <h3>Twitter</h3>
    <br>hier meer Facebook data<br>
      <div style="width: 200px;
                height: 80px;
                margin-left: 80px;
                margin-top: 20px;
                background-color: #eee;
                overflow: auto;">Hier heeeeeeeeeeel veeel tekst dat onzinning is voor de overlfow wat je weet zelf G vat het niet personal man
      </div>
    </div>
  </div>
</div>

@endsection
