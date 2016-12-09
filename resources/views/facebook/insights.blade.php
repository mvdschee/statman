<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <script src="{{asset('resources/assets/js/Chart.js')}}"></script>

       
    </head>
    <body>
        <script>
            var myChart = new Chart({...})
        </script>

        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md"><h1>Facebook</h1></div>
                    
                    <?php
                        $dates_input='';
                        $data_fb_input='';

                        foreach($data[0]['values'] as $key => $value){
                            $fbdate = strtotime($value["end_time"]);
                            $date = date('d.m.Y', $fbdate);

                            $dates_input .= '"' . $date . '", ';
                            $data_fb_input .= $value["value"] . ", "; 
                        }

                        //dd($dates_input);
                    ?>

                    <div class="col">
                        <canvas id="myChart" width="800" height="400"></canvas>
                    </div>            
                    
                </div>

            </div>
        </div>
    </body>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo $dates_input; ?>],
                datasets: [{
                    label: 'Facebook views',
                    fill: true,
                    data: [<?php echo $data_fb_input; ?>],
                    backgroundColor: [
                        'rgba(99,132,255, 1)',
                    ],
                    borderColor: [
                        'rgb(44, 76, 193)',
                    ],
                    borderWidth: 2,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                 scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
</html>