<?php
    include("../../../phpfiles/connection.php");

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

        /* User creation query */
        $new_query = "INSERT INTO tbluser(username, password, type, profile)
        VALUES('$contactnumber', '12345678', 'user', 'default.jpg')";
        $new_result = $conn -> query($new_query); 

        /* getting the user id for resident foreignkey */
        $uinfoquery = "SELECT * FROM tbluser WHERE username = '$contactnumber';";
        $uinforesult = $conn -> query($uinfoquery); 
        $uinforow = mysqli_fetch_array($uinforesult);

        $userid = $uinforow['id'];

        /* resident creation query */
        $new_query = "INSERT INTO resident_table(user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$userid','$fname','$mname','$lname','$suffix','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active');
        
        UPDATE registration
        SET status = 'accepted'
        WHERE id = '".$_POST['app_id']."'";
        $new_result = $conn -> multi_query($new_query); 
        
        header("location:residency_application.php");
    }
?>