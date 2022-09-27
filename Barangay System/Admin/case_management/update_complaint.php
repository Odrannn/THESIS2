<?php
    session_start();
    include("../../phpfiles/connection.php");

    $res_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE resident_id='$res_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    
    echo $official_id;
    if (isset($_POST['solve'])) {
        $id = $_POST['user_id'];
        $query = "UPDATE complaint_table
        SET complaint_status = 'solved', official_ID = '$official_id'
        WHERE complaint_ID = '$id'";
        echo $official_id;
        echo $id;
        $result = $conn -> query($query);

        header("location:case_management.php");
    } 
?>