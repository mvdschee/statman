@extends('layouts.app')

@section('content')
<body>

<div class="container-fluid">
  <h2>Monitool</h2>
  <ul class="nav nav-pills" role="tablist">
    <li class="active"><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
      <form class="navbar-form navbar-right">
       <input type="text" class="form-control" placeholder="Search...">
     </form>
        
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Tutorials <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">HTML</a></li>
        <li><a href="#">CSS</a></li>
        <li><a href="#">JavaScript</a></li>                        
      </ul>
    </li>
  </ul>
</div>
  
</body>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Monitool</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>


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
