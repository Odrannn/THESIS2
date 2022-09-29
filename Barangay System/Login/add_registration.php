<?php

    $response = array(
        'status' => 0,
        'message' => 'Form submission Failed'
    );

    include("../phpfiles/connection.php");
    //getting existing number 
    $exquery = "SELECT contactnumber FROM resident_table;";
    $exresult = $conn -> query($exquery); 
    $exrow = mysqli_fetch_array($exresult);
    
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
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
    
    $num = array();

    while($exrow = mysqli_fetch_array($exresult)){
        $num[] = $exrow[0];
    }

    if (in_array($contactnumber , $num)){
        $response['message'] = "Contact number already";
        
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
            $query = "INSERT INTO registration(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,status,img_path)
            VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','pending','$new_img_name')";
            $result = $conn -> query($query);

            $response['message'] = "Successfully registered";
            $response['status'] = 1;
        }
    }

    

    echo json_encode($response);
?>