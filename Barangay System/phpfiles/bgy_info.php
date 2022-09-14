<?php
    include("connection.php");
    $query = "SELECT * FROM bgy_info;";
    $result = $conn -> query($query);
    $row = $result -> fetch_array();
?>