<?php
    session_start();

    $res_ID = $_SESSION['user_id'];
    
    if (isset($_POST['solve'])) {
        $id = $_POST['user_id'];
        include("../../phpfiles/connection.php");

        
        $query = "UPDATE complaint_table
        SET complaint_status = 'solved' set
        WHERE complaint_ID = '$id'";
        $result = $conn -> query($query);

        header("location:case_management.php");
    } 
?>