<?php
    include("../../phpfiles/connection.php");
    
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
        $response['message'] = "Name already exists.";

    } else if (mysqli_num_rows($exresult)>0){
        $response['message'] = "Contact number already exists.";
        
    } else if (mysqli_num_rows($exresult2)>0){
        $response['message'] = "Email already exists.";
    } else {
        $userpassword = date("Y").time();
        $query = "INSERT INTO tbluser(username, password, type, profile, status)
        VALUES('$contactnumber', '$userpassword', 'user', 'default.jpg', 'active')";
        $result = $conn -> query($query); 
        
        include("../../phpfiles/bgy_info.php");
        $smsemail = "bernard.mazo04@gmail.com";
        $password = "Mazo20181132826";
        $apicode = "PR-BERNA461967_SZ8D9";
        $number = $contactnumber;
        $message = "You are added as a resident of Barangay " . $row[3] . ".\n ACCOUNT DETAILS \nUsername: ". $contactnumber . " \nPassword: " . $userpassword;
        
        itexmo($smsemail, $password, $number, $message, $apicode);
        
        /* getting the user id for resident foreignkey */
        $uinfoquery = "SELECT * FROM tbluser WHERE username = '$contactnumber';";
        $uinforesult = $conn -> query($uinfoquery); 
        $uinforow = mysqli_fetch_array($uinforesult);

        $userid = $uinforow['id'];

        /* resident creation query */
        $query = "INSERT INTO resident_table(user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$userid','$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
        $result = $conn -> query($query);

        $response['message'] = "Successfully Added";
        $response['status'] = 1;
    }
    
    echo json_encode($response);
?>