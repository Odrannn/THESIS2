<?php
    session_start();
    include("../../../phpfiles/connection.php");
    date_default_timezone_set('Asia/Manila'); // SET TIMEZONE

    //get official id
    $user_ID = $_SESSION['user_id'];
    $senderID = $_POST['sender_id'];
    
    $query = "SELECT * FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    $message = $row['position'].". ".$row['name']. " ". "<br>sent a feedback to your suggestion.";
    $officialName = $row['position'].". ".$row['name'];

    $query = "SELECT contactnumber FROM resident_table WHERE user_id='$senderID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $contactnumber = $row['contactnumber'];
    
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

        $smsemail = "bernard.mazo04@gmail.com";
        $password = "Mazo20181132826";
        $apicode = "PR-BERNA461967_SZ8D9";
        $number = $contactnumber;
        $smsmessage = "NOTIFICATION FROM YOUR SENT SUGGESTION: " . $officialName . ": " . $feedback . ".";

        itexmo($smsemail, $password, $number, $smsmessage, $apicode);
    } 

    function itexmo($email,$password,$number,$message,$apicode)
    {
        $ch = curl_init();
        $recipient = array();
        array_push($recipient, $number);
        $itexmo = array('Email' => $email,  'Password' => $password, 'ApiCode' => $apicode, 'Recipients' => $recipient, 'Message' => $message);
        curl_setopt($ch, CURLOPT_URL,"https://api.itexmo.com/api/broadcast");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($itexmo));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec ($ch);
        curl_close ($ch);
    }
?>