<?php
    include("connection.php");
    $query = "SELECT * FROM case_option;";
    $result = $conn -> query($query);
?>