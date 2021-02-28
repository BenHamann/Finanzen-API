<?php
    $key = file_get_contents('key.txt');
    $func = "DIGITAL_CURRENCY_MONTHLY";
    $symbol = "BTC";
    $market = "EUR";
    $request = "https://www.alphavantage.co/query?function={$func}&symbol={$symbol}&market={$market}&outputsize=compact&apikey={$key}";
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
            <canvas id="chart">
                
            </canvas>
        </main>
        <script type="text/javascript">
            const xLabels = []
            const yData = {
                open: [],
                high: [],
                low: [],
                close: []
            }
            function test() {
                getData()
                console.log(yData.open[3]);
                console.log("Buh");
            }

            async function getData(){
                const request = "<?= $request ?>"
                await fetch(request)
                    .then((response) => {
                        if(response.ok){
                            return response.json()
                        }
                        else{
                            console.log("Fetch error")
                        }
                    })
                    .then((data) => {
                        // Work with JSON data here
                        console.log(data)
                        for(var key in data['Time Series (Digital Currency Monthly)']){
                            xLabels.push(key)
                            yData.open.push(data['Time Series (Digital Currency Monthly)'][key]['1a. open (EUR)'])
                            yData.high.push(data['Time Series (Digital Currency Monthly)'][key]['2a. high (EUR)'])
                            yData.low.push(data['Time Series (Digital Currency Monthly)'][key]['3a. low (EUR)'])
                            yData.close.push(data['Time Series (Digital Currency Monthly)'][key]['4a. close (EUR)'])
                        }
                    })
                    .catch((err) => {
                        console.log("Fetch error")
                            // Do something for an error here
                    }) 
            }
                
            async function chartIt(){
                await getData()
                const ctx = document.getElementById('chart').getContext('2d')
                const myChart = new Chart(ctx, {
                    type: 'line',
                    options: {
                        title: {
                            display: true,
                            position: 'top',
                            fontSize: 20,
                            text: 'BTC Kurs'
                            
                        }
                    },
                    data: {
                        labels: xLabels,
                        datasets: [{
                            label: 'Open',
                            fill: false,
                            data: yData.open,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)', 
                            borderWidth: 1
                        },{
                            label: 'High',
                            fill: false,
                            data: yData.high,
                            backgroundColor:'rgba(99, 255, 132, 0.2)',
                            borderColor: 'rgba(99, 255, 132, 1)',
                            borderWidth: 1  
                        },{
                            label: 'Low',
                            fill: false,
                            data: yData.low,
                            backgroundColor:'rgba(99, 132, 255, 0.2)',
                            borderColor: 'rgba(99, 132, 255, 1)',
                            borderWidth: 1  
                        },{
                            label: 'Close',
                            fill: false,
                            data: yData.close,
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
            test()
        </script>
    </body>
</html>

