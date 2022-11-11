<?php
    include("connection.php");
    $query = "SELECT availability FROM modules_available;";
    $result = $conn -> query($query);

    $i = 0;
    while($row = $result -> fetch_array()){
        $availability[$i] = $row[0];
        $i += 1;
    }
?>