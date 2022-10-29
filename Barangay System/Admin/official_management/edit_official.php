<?php
    include("../../phpfiles/connection.php");

    $officialid = $_POST['official_id'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];


    /* official end query */
    $query = "UPDATE tblofficial SET term_start = '$term_start', term_end = '$term_end' WHERE official_id = '$officialid';";
    $result = $conn -> query($query);

    header("location:official_management.php");
    
?>