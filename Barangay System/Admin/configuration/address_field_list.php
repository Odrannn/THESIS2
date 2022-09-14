<?php
    include("../../phpfiles/connection.php");
    $query = "SELECT * FROM address_fields;";
    $result = $conn -> query($query);
?>