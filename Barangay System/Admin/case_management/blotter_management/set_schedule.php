<?php
    session_start();
    include("../../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    $complainant_ID = $_POST['complainant_id'];
    $complainee_ID = $_POST['complainee_id'];
    $message = "You are invited to the barangay hall <br> to settle the blotter that you are involved.";
    
    if (isset($_POST['set'])) {
        $id = $_POST['blotter_id'];
        $date = $_POST['dateh'];
        $time = $_POST['timeh'];
        $query = "UPDATE blotter_table
        SET status = 'scheduled', official_ID = '$official_id', settlement_schedule = '$date', settlement_time = '$time'
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Filed Blotter','$message', '$official_id', '$complainant_ID','$notifdate','0');
        INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Filed Blotter','$message', '$official_id', '$complainee_ID','$notifdate','0'); ";
        $notifresult = $conn -> multi_query($notifquery);
        header("location:blotter_management.php");
    }
?>