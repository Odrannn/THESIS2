<?php
    include("../../phpfiles/connection.php");
    $queryh = "SELECT * FROM healthcare_availability;";
    $resulth = $conn -> query($queryh);
    $rowh = $resulth -> fetch_array();
?>