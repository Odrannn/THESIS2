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

    $query = "SELECT contactnumber FROM resident_table WHERE user_id='$senderID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $contactnumber = $row['contactnumber'];
    
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

        $smsemail = "bernard.mazo04@gmail.com";
        $password = "Mazo20181132826";
        $apicode = "PR-BERNA461967_SZ8D9";
        $number = $contactnumber;
        $message = "NOTIFICATION FROM YOUR FILED COMPLAINT: Your complaint has been resolved.";

        itexmo($smsemail, $password, $number, $message, $apicode);

        header("location:case_management.php");
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