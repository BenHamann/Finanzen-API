<?php
    $host = "localhost";
    $user = "root";
    $pass = NULL;
    $database = "api";

    $conn = mysqli_connect($host, $user, $pass, $database) or die($conn -> mysqli_error);

    function update($conn, $open, $high, $low, $close, $date, $id){
        echo $date;
        echo "<br>";
        $result = mysqli_query($conn, "SELECT * FROM apidata");
        if(mysqli_num_rows($result) > 25){
            mysqli_query($conn, "UPDATE apidata SET open = '{$open}', high = '{$high}', low = '{$low}', close = '{$close}', date = '{$date}' WHERE ID = '{$id}'");
            mysqli_query($conn, "UPDATE konfig SET trash = 6 WHERE id = 1 ");

        }
        else{
            mysqli_query($conn, "INSERT INTO apidata (open, high, low, close, date) VALUES ('{$open}', '{$high}', '{$low}', '{$close}' , '{$date}')");
            mysqli_query($conn, "UPDATE konfig SET trash = 6 WHERE id = 1 ");
        }
        
    }
    function select($conn){
        $datas = [];
        $result = mysqli_query($conn, "SELECT * FROM apidata");
        while($row = mysqli_fetch_assoc($result)){
            $open[] = $row['open'];
            $high[] = $row['high'];
            $low[] = $row['low'];
            $close[] = $row['close'];
            $date[] = $row['date'];
        }
        array_push($datas, $open, $high, $low, $close, $date);
        return $datas;
        
    }
?>