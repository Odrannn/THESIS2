<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    $query = "SELECT * FROM tbluser;";
    $result = $conn -> query($query);
    $row = $result -> fetch_array();
?>