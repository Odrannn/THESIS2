<?php
    include("../../phpfiles/connection.php");
    /* getting existing number */
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
        echo "contact num already exists!!";
        
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
        $query = "INSERT INTO resident_table(user_id,fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$userid','$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
        $result = $conn -> query($query);

        header("location:resident_management.php");
    }
?>