<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    $query = "SELECT * FROM bgy_info;";
    $result = $conn -> query($query);
    $row = $result -> fetch_array();
?>