<?php
    session_start();
    include("../../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    
    if (isset($_POST['settled'])) {
        $id = $_POST['blotter_id'];
        $result = $_POST['result'];
        $query = "UPDATE blotter_table
        SET status = 'settled', official_ID = '$official_id', result_of_settlement = '$result'
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        header("location:blotter_management.php");
    } 

    if (isset($_POST['unsettled'])) {
        $id = $_POST['blotter_id'];
        $result = $_POST['result'];
        $query = "UPDATE blotter_table
        SET status = 'unsettled', official_ID = '$official_id', result_of_settlement = '$result'
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        header("location:blotter_management.php");
    } 
    if (isset($_POST['reset'])) {
        $id = $_POST['blotter_id'];
        $query = "UPDATE blotter_table
        SET status = 'unscheduled', official_ID = NULL, result_of_settlement = '', settlement_schedule = '', settlement_time = ''
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        header("location:blotter_management.php");
    } 
?>