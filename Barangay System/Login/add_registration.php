<?php
    include("../phpfiles/connection.php");
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

    $response = array(
        'status' => 0,
        'message' => 'Form submission Failed'
    );
    
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $birthplace = $_POST['birthplace'];
    $civilstatus = $_POST['civilstatus'];
    $birthday = $_POST['birthday'];

    //get age
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthday), date_create($today));
    $age = $diff->format('%y');

    $unitnumber = $_POST['unitnumber'];
    $purok = $_POST['purok'];
    $sitio = $_POST['sitio'];
    $street = $_POST['street'];
    $subdivision = $_POST['subdivision'];
    $contactnumber = $_POST['contactnumber'];
    $email = $_POST['email'];
    $religion = $_POST['religion'];
    if($_POST['occupation']==''){
        $occupation = "none";
    } else {
        $occupation = $_POST['occupation'];
    }
    $education = $_POST['education'];
    $nationality = $_POST['nationality'];
    if($_POST['disability']==''){
        $disability = "none";
    } else {
        $disability = $_POST['disability'];
    }
    
    //validation if name already registered
    $exquery3 = "SELECT * FROM resident_table WHERE (fname LIKE '$fname' AND mname LIKE '$mname' AND lname LIKE '$lname' AND suffix LIKE '$suffix');";
    $exresult3 = $conn -> query($exquery3); 

    //getting existing number 
    $exquery = "SELECT * FROM resident_table WHERE contactnumber = '$contactnumber';";
    $exresult = $conn -> query($exquery); 

    //validation if email already existing
    $exquery2 = "SELECT * FROM resident_table WHERE email = '$email';";
    $exresult2 = $conn -> query($exquery2); 

    if (mysqli_num_rows($exresult3)>0){
        $response['message'] = "Name already registered.";

    } else if ((mysqli_num_rows($exresult)>0) && ($age >= 18)){
        $response['message'] = "Contact number already exists.";
        
    } else if ((mysqli_num_rows($exresult2)>0) && ($age >= 18)){
        $response['message'] = "Email already exists.";
    } else {
        $img_name = $_FILES['validID']['name'];
        $img_size = $_FILES['validID']['size'];
        $tmp_name = $_FILES['validID']['tmp_name'];
        $error = $_FILES['validID']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'validID/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            //insert to db
            if($age < 18){
                $query = "INSERT INTO registration(fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,status,img_path)
                VALUES('$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','pendingforresidency','$new_img_name')";
                $result = $conn -> query($query);
            }
            else{
                $query = "INSERT INTO registration(fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,status,img_path)
                VALUES('$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','pendingforaccountandresidency','$new_img_name')";
                $result = $conn -> query($query);
            }
            
            $date1 = date('y-m-d h:i:s');
            $query = "INSERT INTO admin_notification(notification_type, message, source_ID, date_time, status)
            VALUES ('Residency Registration','New residency application.',NULL,'$date1','0');";
            $result = $conn -> query($query);
            
            $email = "bernard.mazo04@gmail.com";
            $password = "Mazo20181132826";
            $apicode = "PR-BERNA461967_SZ8D9";
            $number = $contactnumber;
            $message = "Registration Pending: Your Registration is in process. We will update you once your application is accepted.";

            itexmo($email, $password, $number, $message, $apicode);

            $response['message'] = "Successfully registered. You will receive a confirmation message of your registration via sms.";
            $response['status'] = 1;
        }
    }

    

    echo json_encode($response);

    
?>