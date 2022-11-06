<?php
    include("../../phpfiles/connection.php");
    
    $resID = $_POST['resident_id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
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
    $status = $_POST['status'];
    
    $query = "UPDATE resident_table
    SET fname = '$fname', 
        mname = '$mname',
        lname = '$lname',
        gender = '$gender',
        birthplace = '$birthplace',
        civilstatus = '$civilstatus',
        birthday = '$birthday',
        unitnumber = '$unitnumber',
        purok = '$purok',
        sitio = '$sitio',
        street = '$street',
        subdivision = '$subdivision',
        contactnumber = '$contactnumber',
        email = '$email',
        religion = '$religion',
        occupation = '$occupation',
        education = '$education',
        nationality = '$nationality',
        disability = '$disability',
        status = '$status'

    WHERE id = $resID;";
    $result = $conn -> query($query);

    /*$query = "INSERT INTO resident_table(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
    VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
     */

    header("location:resident_management.php");
?>