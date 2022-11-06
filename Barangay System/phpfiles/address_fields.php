<?php
    include("connection.php");
    $query = "SELECT * FROM address_fields;";
    $result = $conn -> query($query);
?>