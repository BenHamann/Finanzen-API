<?php
    include 'dbconnection.php';
    $data = select($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            *{
                padding: 0;
                margin: 0;
            }
            main{
                padding: 1.5em 0 0 1.5em;
                margin: 1.5em 0 0 1.5em;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" type="text/javascript"></script> 
    </head>
    
    <body style='font-family: "Bahnschrift Light"'>
        <main>
            <h1 style="padding-left: 1em">BTC-Course</h1>
            <canvas id="chart" height="100"></canvas>
        </main>
        <script type="text/javascript">
            
            const xLabels = []
            const yData = {
                open: [],
                high: [],
                low: [],
                close: []
            }
            yData.open.push(<?= json_encode($data[0]) ?>)
            yData.high.push(<?= json_encode($data[1]) ?>)
            yData.low.push(<?= json_encode($data[2]) ?>)
            yData.close.push(<?= json_encode($data[3]) ?>)
            xLabels.push(<?= json_encode($data[4]) ?>)
                
            
            function chartIt(){
                const ctx = document.getElementById('chart').getContext('2d')
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: xLabels[0],
                        datasets: [{
                            label: 'Open',
                            fill: false,
                            data: yData.open[0],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)', 
                            borderWidth: 1
                        },{
                            label: 'High',
                            fill: false,
                            data: yData.high[0],
                            backgroundColor:'rgba(99, 255, 132, 0.2)',
                            borderColor: 'rgba(99, 255, 132, 1)',
                            borderWidth: 1  
                        },{
                            label: 'Low',
                            fill: false,
                            data: yData.low[0],
                            backgroundColor:'rgba(99, 132, 255, 0.2)',
                            borderColor: 'rgba(99, 132, 255, 1)',
                            borderWidth: 1  
                        },{
                            label: 'Close',
                            fill: false,
                            data: yData.close[0],
                            backgroundColor:'rgba(190, 190, 99, 0.2)',
                            borderColor: 'rgba(190, 190, 99, 1)',
                            borderWidth: 1  
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function(value, index, values){
                                        return value + '€';
                                    }
                                }
                            }]
                        }
                    }
                })
            } 
            chartIt()
        </script>
    </body>
</html>

