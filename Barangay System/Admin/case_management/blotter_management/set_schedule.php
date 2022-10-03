<?php
    session_start();
    include("../../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    
    if (isset($_POST['set'])) {
        $id = $_POST['blotter_id'];
        $date = $_POST['dateh'];
        $time = $_POST['timeh'];
        $query = "UPDATE blotter_table
        SET status = 'scheduled', official_ID = '$official_id', settlement_schedule = '$date', settlement_time = '$time'
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        header("location:blotter_management.php");
    }
?>