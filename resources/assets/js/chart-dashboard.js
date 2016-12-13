 //var chartData = generateChartData();

console.log(chartData);
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 0,
    "autoMarginOffset": 20,
    "marginTop": 7,
    "dataProvider": chartData,
    "valueAxes": [{
        "axisAlpha": 0.2,
        "dashLength": 1,
        "position": "left"
    }],
    "mouseWheelZoomEnabled": true,
    "graphs": [{
        "id": "g1",
        "balloonText": "[[value]]",
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "hideBulletsCount": 50,
        "title": "red line",
        "valueField": "visits",
        "useLineColorForBulletBorder": true,
        "balloon":{
            "drop":false
        }
    }],
    "chartScrollbar": {
        "autoGridCount": true,
        "graph": "g1",
        "scrollbarHeight": 40
    },
    "chartCursor": {
       "limitToGraph":"g1"
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    }
});

chart.addListener("rendered", zoomChart);
zoomChart();

// this method is called when chart is first inited as we listen for "rendered" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
}


// // generate some random data, quite different range
// function generateChartData() {
//     var chartData = [];
//     var firstDate = new Date();
//     firstDate.setDate(firstDate.getDate() - 5);

//     for (var i = 0; i < 100; i++) {
//         // we create date objects here. In your data, you can have date strings
//         // and then set format of your dates using chart.dataDateFormat property,
//         // however when possible, use date objects, as this will speed up chart rendering.
//         var newDate = new Date(firstDate);
//         newDate.setDate(newDate.getDate() + i);

//         var visits = Math.round(Math.random() * (40 + i / 5)) + 20 + i;

//         chartData.push({
//             date: newDate,
//             visits: visits
           
//         });
//     }
//     return chartData;
// }


//--------------------------------chartjs----------------------------------------// 

// var ctx = document.getElementById("myChart");
// var myChart = new Chart(ctx, {
//   type: 'line',
//   data: {
//       labels: [12, 13, 24, 53, 13, 24, 53],
//       datasets: [
//       {
//           label: 'Youtube views',
//           fill: false,
//           data: [12, 43, 32, 2, 43, 32, 2],
//           backgroundColor: [
//               'rgba(255, 99, 132, 0.2)',
//           ],
//           borderColor: [
//               'rgba(255,99,132,1)',
//           ],
//           borderWidth: 1
//       },
//       {
//           label: 'Facebook views',
//           fill: false,
//           data: [43, 34, 12, 56, 34, 12, 56],
//           backgroundColor: [
//               'rgba(99,132,255, 0.2)',
//           ],
//           borderColor: [
//               'rgb(99,132,255)',
//           ],
//           borderWidth: 1
//       }
//       ]
//   },
//   options: {
//     responsive: true,
//     maintainAspectRatio: false,
//     legend: {
//           display: true,
//           position: 'top'
//       },
//     scales: {
//         yAxes: [{
//             ticks: {
//                 beginAtZero:true
//             }
//         }]
//     }
//   }
// });