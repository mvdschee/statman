@extends('layouts.dashboard')
@section('content')
<!-- <script>
  var myChart = new Chart({...})
</script> -->
<div class="dashboard">
  <div class="container-fluid">
    <div class="row dashboard-top-half">
      <div class="col-md-12">
        <div class="panel graph">
          <p class="panel-title text-left">Facebook & Youtube - Views</p>
          <div class="buttons-filter buttons-bar"></div>
          <div class="buttons-filter"></div>
          <div id="chartdiv"></div>
        </div>
      </div>
    </div>
    <div class="row dashboard-bottom-half">
      <div class="col-md-4">
        <div class="panel">
          <p class="panel-title">Overall</p>

        </div>
      </div>
      <div class="col-md-4">
        <div class="panel">
          <p class="panel-title">Facebook</p>

        </div>
      </div>
      <div class="col-md-4">
        <div class="panel">
          <p class="panel-title">Youtube</p>

        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $fbDataArray = [];

  foreach($data[0]['values'] as $value){
     $fbdate = strtotime($value["end_time"]);
      $date = date('D M d Y h:i:s OT (e)', $fbdate);
     $fbDataArray[] = array('date' => $date, 'visits' => $value["value"]);
  }

   $chartData = json_encode($fbDataArray);

  //dd($fbDataArray);
?>
<script type="text/javascript">
  var chartData = <?php echo $chartData; ?>
</script>
<script src="./resources/assets/js/chart-dashboard.js"></script>
@endsection