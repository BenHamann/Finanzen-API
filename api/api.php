<?php
    $conn = NULL;
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
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'/>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body style='font-family: "Bahnschrift Light"'>
        <main>
            <h1 style="padding-left: 1em">BTC-Course</h1>
            <canvas id="chart" height="100"></canvas>
            <div>
                <table id="Open">
                    <tr>
                        <td id="date_old_open">NA</td>
                        <td id="date_new_open">NA</td>
                        <td>Open</td>
                    </tr>
                    <tr>
                        <td id="quantity_old_open">NA</td>
                        <td id="quantity_new_open">NA</td>
                        <td id="dif_erg_open">NA</td>
                    </tr>

                </table>
                <table id="High">
                    <tr>
                        <td id="date_old_high">NA</td>
                        <td id="date_new_high">NA</td>
                        <td>High</td>
                    </tr>
                    <tr>
                        <td id="quantity_old_high">NA</td>
                        <td id="quantity_new_high">NA</td>
                        <td id="dif_erg_high">NA</td>
                    </tr>
                </table>
                <table id="Low">
                    <tr>
                        <td id="date_old_low">NA</td>
                        <td id="date_new_low">NA</td>
                        <td>Low</td>
                    </tr>
                    <tr>
                        <td id="quantity_old_low">NA</td>
                        <td id="quantity_new_low">NA</td>
                        <td id="dif_erg_low">NA</td>
                    </tr>
                </table>
                <table id="Close">
                    <tr>
                        <td id="date_old_close">NA</td>
                        <td id="date_new_close">NA</td>
                        <td>Close</td>
                    </tr>
                    <tr>
                        <td id="quantity_old_close">NA</td>
                        <td id="quantity_new_close">NA</td>
                        <td id="dif_erg_close">NA</td>
                    </tr>
                </table>
            </div>
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

            function calcDif(New, Old){
                let dif = (New-Old)/Old;
                return dif.toFixed(5);
            }

            function calcOpen() {
                var data_new = yData.open[0][0];
                var data_old = yData.open[0][1];
                var data_date_old = xLabels[0][1];
                var data_date_new = xLabels[0][0];
                var data_result = calcDif(data_new, data_old)
                document.getElementById('date_old_open').innerHTML = data_date_old ;
                document.getElementById('date_new_open').innerHTML = data_date_new ;
                document.getElementById('quantity_old_open').innerHTML = data_old ;
                document.getElementById('quantity_new_open').innerHTML = data_new ;
                document.getElementById('dif_erg_open').innerHTML = data_result ;
                if(data_result < 0){
                    document.getElementById("dif_erg_open").style.color = "#f00";
                }else if (data_result > 0){
                    document.getElementById("dif_erg_open").style.color = "#4ba24b";
                }
            }
            function calcHigh() {
                var data_new = yData.high[0][0];
                var data_old = yData.high[0][1];
                var data_date_old = xLabels[0][1];
                var data_date_new = xLabels[0][0];
                var data_result = calcDif(data_new, data_old)
                document.getElementById('date_old_high').innerHTML = data_date_old ;
                document.getElementById('date_new_high').innerHTML = data_date_new ;
                document.getElementById('quantity_old_high').innerHTML = data_old ;
                document.getElementById('quantity_new_high').innerHTML = data_new ;
                document.getElementById('dif_erg_high').innerHTML = data_result ;
                if(data_result < 0){
                    document.getElementById("dif_erg_high").style.color = "#f00";
                }else if (data_result > 0){
                    document.getElementById("dif_erg_high").style.color = "#4ba24b";
                }
            }
            function calcLow() {
                var data_new = yData.low[0][0];
                var data_old = yData.low[0][1];
                var data_date_old = xLabels[0][1];
                var data_date_new = xLabels[0][0];
                var data_result = calcDif(data_new, data_old)
                document.getElementById('date_old_low').innerHTML = data_date_old ;
                document.getElementById('date_new_low').innerHTML = data_date_new ;
                document.getElementById('quantity_old_low').innerHTML = data_old ;
                document.getElementById('quantity_new_low').innerHTML = data_new ;
                document.getElementById('dif_erg_low').innerHTML = data_result ;
                if(data_result < 0){
                    document.getElementById("dif_erg_low").style.color = "#f00";
                }else if (data_result > 0){
                    document.getElementById("dif_erg_low").style.color = "#4ba24b";
                }
            }
            function calcClose() {
                var data_new = yData.close[0][0];
                var data_old = yData.close[0][1];
                var data_date_old = xLabels[0][1];
                var data_date_new = xLabels[0][0];
                var data_result = calcDif(data_new, data_old)
                document.getElementById('date_old_close').innerHTML = data_date_old ;
                document.getElementById('date_new_close').innerHTML = data_date_new ;
                document.getElementById('quantity_old_close').innerHTML = data_old ;
                document.getElementById('quantity_new_close').innerHTML = data_new ;
                document.getElementById('dif_erg_close').innerHTML = data_result ;
                if(data_result < 0){
                    document.getElementById("dif_erg_close").style.color = "#f00";
                }else if (data_result > 0){
                    document.getElementById("dif_erg_close").style.color = "#4ba24b";
                }
            }
            function loadFunktions() {

                calcClose();
                calcHigh();
                calcLow();
                calcOpen();
            }
            loadFunktions();

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

