<?php
    session_start();
    include("../../../phpfiles/connection.php");

    //get official id
    $user_ID = $_SESSION['user_id'];
    $senderID = $_POST['sender_id'];
    
    $query = "SELECT * FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    $message = $row['position'].". ".$row['name']. " ". "<br>sent a feedback to your suggestion.";
    
    if (isset($_POST['update'])) {
        $id = $_POST['suggestion_id'];
        $feedback = $_POST['feedback'];
        $query = "UPDATE suggestion_table
        SET suggestion_status = 'noticed', official_ID = '$official_id', suggestion_feedback = '$feedback'
        WHERE suggestion_ID = '$id'";
        $result = $conn -> query($query);

        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Sent Suggestion','$message', '$official_id', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);
        header("location:suggestion_management.php");
    } 
?>