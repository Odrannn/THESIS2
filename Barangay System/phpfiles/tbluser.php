<?php
    include("connection.php");
    $query = "SELECT * FROM tbluser;";
    $result = $conn -> query($query);
    $row = $result -> fetch_array();
?>