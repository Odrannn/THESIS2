<?php
    session_start();
    include("../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $senderID = $_POST['sender_id'];
    
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    
    if (isset($_POST['solve'])) {
        $id = $_POST['user_id'];
        $query = "UPDATE complaint_table
        SET complaint_status = 'solved', official_ID = '$official_id'
        WHERE complaint_ID = '$id'";
        echo $official_id;
        echo $id;
        $result = $conn -> query($query);

        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Filed Complaint','Your complain has been marked solved.', '$official_id', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);
        header("location:case_management.php");
    } 
?>