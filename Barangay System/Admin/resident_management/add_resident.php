<?php
    include("../../phpfiles/connection.php");

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
    $age = $_POST['age'];
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

    } else if (mysqli_num_rows($exresult)>0){
        $response['message'] = "Contact number already exists.";
        
    } else if (mysqli_num_rows($exresult2)>0){
        $response['message'] = "Email already exists.";
    } else {
        $query = "INSERT INTO tbluser(username, password, type)
        VALUES('$contactnumber', '12345678', 'user')";
        $result = $conn -> query($query); 

        /* getting the user id for resident foreignkey */
        $uinfoquery = "SELECT * FROM tbluser WHERE username = '$contactnumber';";
        $uinforesult = $conn -> query($uinfoquery); 
        $uinforow = mysqli_fetch_array($uinforesult);

        $userid = $uinforow['id'];

        /* resident creation query */
        $query = "INSERT INTO resident_table(user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$userid','$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
        $result = $conn -> query($query);

        $response['message'] = "Successfully registered";
        $response['status'] = 1;
    }
    
    echo json_encode($response);
?>