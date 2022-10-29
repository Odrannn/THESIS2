<?php
    session_start();
    include("../../../phpfiles/connection.php");
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

    //get official id
    $user_ID = $_SESSION['user_id'];
    $query = "SELECT official_id FROM tblofficial WHERE user_id='$user_ID'";
    $result = $conn -> query($query);
    $row = mysqli_fetch_array($result);
    $official_id = $row[0];
    $complainant_ID = $_POST['complainant_id'];
    $complainee_ID = $_POST['complainee_id'];
    
    if (isset($_POST['set'])) {
        $id = $_POST['blotter_id'];
        $date = $_POST['dateh'];
        $time = $_POST['timeh'];
        $query = "UPDATE blotter_table
        SET status = 'scheduled', official_ID = '$official_id', settlement_schedule = '$date', settlement_time = '$time'
        WHERE blotter_ID = '$id'";
        $result = $conn -> query($query);

        //create notif VARIABLES
        $sqldate = strtotime($date);
        $fdate = date( 'F j, Y', $sqldate );
        $sqldate = strtotime($time);
        $ftime = date( 'g:i a', $sqldate );
        $message = "You are invited to the barangay hall on " . $fdate . ",<br> " . $ftime  . ", to settle the blotter you are involved.";
        $notifdate = date('y-m-d h:i:s');

        //INSERT NOTIF
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Filed Blotter','$message', '$official_id', '$complainant_ID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Filed Blotter','$message', '$official_id', '$complainee_ID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);
        //$notifquery1 = "UPDATE user_notification set resident_ID = NULL where resident_ID = '0'";
        //$notifresult1 = $conn -> query($notifquery1);


        /*sms notif */
        $email = "bernard.mazo04@gmail.com";
        $password = "Mazo20181132826";
        $apicode = "PR-BERNA461967_SZ8D9";
        $message = "You are invited to the barangay hall on " . $fdate . ", " . $ftime  . ", to settle the blotter you are involved.";

        //get contact number of complainant and complainee.
        if($complainee_ID==''){
            $result = $conn -> query("SELECT contactnumber from resident_table where id = '$complainant_ID';");
            $row = $result -> fetch_assoc();
            $compt = $row['contactnumber'];
            $results = itexmo($email, $password, $compt, $message, $apicode);
        } else {
            $result = $conn -> query("SELECT contactnumber from resident_table where id = '$complainant_ID';");
            $row = $result -> fetch_assoc();
            $compe = $row['contactnumber'];

            $result = $conn -> query("SELECT contactnumber from resident_table where id = '$complainee_ID';");
            $row = $result -> fetch_assoc();
            $compt = $row['contactnumber'];

            $results = itexmo($email, $password, $compt, $message, $apicode);
            $results = itexmo($email, $password, $compe, $message, $apicode);
        }
        
        header("location:blotter_management.php");

        
    }
?>