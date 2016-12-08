@extends('layouts.app')

@section('content')
<div class="panel-group" id="accordion">
  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
  </a>
</div>
<div id="collapse1" class="panel-collapsed collapse out">
  <div class="panel-body">Hier zijn de filter opties</div>
    <div class="checkbox">
      <label><input type="checkbox"> Filter options 1</label>
    </div>
      <div class="checkbox">
        <label><input type="checkbox"> Filter options 2</label>
      </div>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown
            <div class="btn btn-primary accordion.active">
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#">Ein</a></li>
              <li><a href="#">Zwei</a></li>
              <li><a href="#">Drei</a></li>
            </ul>
        </div> 
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
 <div class="row">
  <div class= "col-md-8 graph-gyazo">
   <img src="./public/img/graph-gyazo.png" class="img-rounded" alt="Cinque Terre" width="1250" height="384">
  </div>
    <div class="col-md-2 navbar-right" style="background-color:white; margin-top: -25px; height:375px;">
      <ul class="nav">
        <img src="./public/img/ic_insert_chart_black_24dp_2x.png"> 
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        <img src="./public/img/ic_filter_list_black_24dp_2x.png"></a>        
        <li class="active"><a href="#">Overview<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Export</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>
<div class="container-fluid">
  <div class="rowmediachannels text-center">
    <div class="rowmediaeach col-md-4">
    <h3>Overall</h3>
    <br>hier meer facebook data<br>
    <img src="./public/img/procentdonut.png"></a>        

  </div>

  <div class="rowmediaeach col-md-4">
  <h3>Facebook</h3>
  <br>hier meer Facebook data<br>
  </div>
  
  <div class="rowmediaeach col-md-4">
  <h3>Youtube</h3>
  <br>hier meer Youtube data<br>
  <div style="width: 400px;
      height: 150px;
      margin-left: 40px;
      margin-top: 20px;
      background-color: #eee;
      overflow: auto;">Lorum ipsum Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
      Lorum ipsum Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
