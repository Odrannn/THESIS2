<?php
    include("../phpfiles/connection.php");

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
        $response['message'] = "Name already registered.";

    } else if (mysqli_num_rows($exresult)>0){
        $response['message'] = "Contact number already exists.";
        
    } else if (mysqli_num_rows($exresult2)>0){
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
            $query = "INSERT INTO registration(fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,status,img_path)
            VALUES('$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','pending','$new_img_name')";
            $result = $conn -> query($query);

            $response['message'] = "Successfully registered";
            $response['status'] = 1;
        }
    }

    

    echo json_encode($response);
?>