<?php
    include("../../../phpfiles/connection.php");
    session_start();
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

    if(isset($_POST['accept_application']))
    {
        $query = "SELECT * FROM registration WHERE id = '".$_POST['app_id']."'";
        $result = $conn -> query($query); 
        $row = mysqli_fetch_array($result);

        $fname = $row["fname"];
        $mname = $row["mname"];
        $lname = $row["lname"];
        $suffix = $row["suffix"];
        $gender = $row['gender'];
        $birthplace = $row['birthplace'];
        $civilstatus = $row['civilstatus'];
        $birthday = $row['birthday'];
        $unitnumber = $row['unitnumber'];
        $purok = $row['purok'];
        $sitio = $row['sitio'];
        $street = $row['street'];
        $subdivision = $row['subdivision'];
        $contactnumber = $row['contactnumber'];
        $email = $row['email'];
        $religion = $row['religion'];
        $occupation = $row['occupation'];
        $education = $row['educational'];
        $nationality = $row['nationality'];
        $disability = $row['disability'];
        $status = $row['status'];

        if($status == 'pendingforaccountandresidency'){
        /* User creation query */
            $new_query = "INSERT INTO tbluser(username, password, type, profile, status)
            VALUES('$contactnumber', '12345678', 'user', 'default.jpg', 'active')";
            $new_result = $conn -> query($new_query); 

            $email = "bernard.mazo04@gmail.com";
            $password = "Mazo20181132826";
            $apicode = "PR-BERNA461967_SZ8D9";
            $number = $contactnumber;
            $message = "Registration Accepted.\n ACCOUNT DETAILS \nUsername: ". $contactnumber . " \nPassword: 12345678";

            /* getting the user id for resident foreignkey */
            $uinfoquery = "SELECT * FROM tbluser WHERE username = '$contactnumber';";
            $uinforesult = $conn -> query($uinfoquery); 
            $uinforow = mysqli_fetch_array($uinforesult);

            itexmo($email, $password, $number, $message, $apicode);

            $userid = $uinforow['id'];

            /* resident creation query */
            $new_query = "INSERT INTO resident_table(user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
            VALUES('$userid','$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active');
            
            UPDATE registration
            SET status = 'accepted'
            WHERE id = '".$_POST['app_id']."'";
            $new_result = $conn -> multi_query($new_query);

        } else if($status == 'pendingforresidency'){
            /* resident creation query */
            $new_query = "INSERT INTO resident_table(fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
            VALUES('$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active');
            
            UPDATE registration
            SET status = 'accepted'
            WHERE id = '".$_POST['app_id']."'";
            $new_result = $conn -> multi_query($new_query);

            include("../../../phpfiles/bgy_info.php");
            $bgyname = $row['bgy_name'];

            /*sms notif */
            $email = "bernard.mazo04@gmail.com";
            $password = "Mazo20181132826";
            $apicode = "PR-BERNA461967_SZ8D9";
            $number = $contactnumber;
            $message = "Registration Accepted. The person you registered is now a resident of Barangay " . $bgyname . ".";
            itexmo($email, $password, $number, $message, $apicode);
        }
        $_SESSION['residencyMessage'] = 1;
        header("location:residency_application.php");
    }
?>

