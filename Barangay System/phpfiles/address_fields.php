<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    $query = "SELECT * FROM address_fields;";
    $result = $conn -> query($query);
?>