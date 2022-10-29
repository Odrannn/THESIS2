<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['edit_user']))
    {
        $userID = $_POST['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        
        
        $query = "UPDATE tbluser
        SET username = '$username', 
            password = '$password', 
            type = '$type'

        WHERE id = $userID;";
        $result = $conn -> query($query);

        /*$query = "INSERT INTO resident_table(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
        VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$education','$nationality','$disability','active')";
        */

        header("location:user_management.php");
    }
?>