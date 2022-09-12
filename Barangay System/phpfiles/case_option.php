<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    $query = "SELECT * FROM case_option;";
    $result = $conn -> query($query);
?>