<?php
    include("../../phpfiles/connection.php");

    $officialid = $_POST['official_id'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];
    $status = $_POST['status'];


    /* official creation query */
    $query = "UPDATE tblofficial
              SET position = '$position', term_start = '$term_start', term_end = '$term_end', status = '$status'
              WHERE official_id = '$officialid';";
    $result = $conn -> query($query);

    header("location:official_management.php");
    
?>