<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");

    if(isset($_POST['accept_application']))
    {
        $conn = new mysqli("localhost", "root", "", "bgy_system");
        $query = "SELECT * FROM registration WHERE id = '".$_POST['app_id']."'";
        $result = $conn -> query($query); 
        $row = mysqli_fetch_array($result);

        $fname = $row["fname"];
        $mname = $row["mname"];
        $lname = $row["lname"];
        $gender = $row['gender'];
        $birthplace = $row['birthplace'];
        $civilstatus = $row['civilstatus'];
        $birthday = $row['birthday'];
        $age = $row['age'];
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

        $new_query = "INSERT INTO resident_table(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
        $new_result = $conn -> query($new_query); 
        header("location:residency_application.php");
    }
?>