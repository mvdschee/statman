<?php 
$data_yt_input='';
$data_yt = array('22', '11', '2', '4', '8', '24', '21', '16', '15');
$data_yt_lenght = count($data_yt);
for ($i=0; $i < $data_yt_lenght; $i++) { 
    $data_yt_input = $data_yt_input.$data_yt[$i].', ';
}

$data_fb_input='';
$data_fb = array('12', '5', '7', '3', '1', '2', '17', '16', '13');
$data_fb_lenght = count($data_fb);
for ($i=0; $i < $data_fb_lenght; $i++) { 
    $data_fb_input = $data_fb_input.$data_fb[$i].', ';
}


$dates_input='';
$dates = array('"15 nov"', 
    '"16 nov"', 
    '"17 nov"', 
    '"18 nov"',
    '"19 nov"', 
    '"20 nov"',
    '"21 nov"',
    '"22 nov"',
    '"23 nov"',);
$dates_lenght = count($dates);
for ($x=0; $x < $dates_lenght; $x++) { 
    $dates_input = $dates_input.$dates[$x].', ';
}

$chartjs = asset('resources/assets/js/Chart.js');

$html =<<<EOT
<!doctype html>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <title>GRAFIEKJES</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <script src="{$chartjs}"></script>
    <script>
        var myChart = new Chart({...})
    </script>
    <h1>Test grafieken</h1>
    <div class="col">
        <canvas id="pieChart" width="800" height="400"></canvas>
    </div>
    <div class="col">
        <canvas id="myChart" width="800" height="400"></canvas>
    </div>
    <div class="col">
        <canvas id="myChart" width="800" height="400"></canvas>
    </div>
    
    
    
    



    <script>
    var ctx = document.getElementById("myChart");
    var ctx1 = document.getElementById("pieChart")
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [{$dates_input}],
            datasets: [
            {
                label: 'Youtube views',
                fill: false,
                data: [{$data_yt_input}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Facebook views',
                fill: false,
                data: [{$data_fb_input}],
                backgroundColor: [
                    'rgba(99,132,255, 0.2)',
                ],
                borderColor: [
                    'rgb(99,132,255)',
                ],
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: false,
             scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    var pieChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ["1", "2", "3"],
            datasets: [
            {
                data: [200,70,40],
                backgroundColor: [
                    'rgb(255,99,132)',
                    'rgb(99,132,255)',
                    'rgb(99,255,132)'
                ]
            }
            ]
        },
        options: {
            responsive: false,
        }
    });
    </script>
</body>
</html>
EOT;
echo $html;
 ?>