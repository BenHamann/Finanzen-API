<?php
    include 'dbconnection.php';
    
    $key = file_get_contents('key.txt');
    $func = "DIGITAL_CURRENCY_DAILY";
    $symbol = "BTC";
    $market = "EUR";
    $id = 1;
    

    $ch = curl_init();

    $url = "https://www.alphavantage.co/query?function={$func}&symbol={$symbol}&market={$market}&outputsize=compact&apikey={$key}";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    
    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $final = json_decode($resp, true);
        $datas = $final['Time Series (Digital Currency Daily)'];
        
        foreach($datas as $date => $values){
            $open = $values['1a. open (EUR)'];
            $high = $values['2a. high (EUR)'];
            $low = $values['3a. low (EUR)'];
            $close = $values['4a. close (EUR)'];
            update($conn, $open, $high, $low, $close, $date, $id);
            $id++;
        }
    }
    curl_close($ch);
    
?>