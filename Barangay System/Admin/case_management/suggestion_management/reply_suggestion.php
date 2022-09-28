<?php
    session_start();
    include("../../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    
    if (isset($_POST['update'])) {
        $id = $_POST['user_id'];
        $feedback = $_POST['feedback'];
        $query = "UPDATE suggestion_table
        SET suggestion_status = 'noticed', official_ID = '$official_id', suggestion_feedback = '$feedback'
        WHERE suggestion_ID = '$id'";
        $result = $conn -> query($query);

        header("location:suggestion_management.php");
    } 
?>