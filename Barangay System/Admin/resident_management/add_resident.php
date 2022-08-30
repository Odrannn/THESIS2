<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system");

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
    

    $query = "INSERT INTO resident_table(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
    VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
    $result = $conn -> query($query); 

    $query = "INSERT INTO tbluser(username, password, type)
    VALUES('$contactnumber', '12345678', 'user')";
    $result = $conn -> query($query); 

    header("location:resident_management.php");
?>