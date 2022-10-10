<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['add_user']))
    {
        $resID = $_POST['id'];
        $type = $_POST['type'];

        $query = "SELECT * FROM resident_table WHERE id = '$resID'";
        $result = $conn -> query($query);
        $row = $result -> fetch_array();
        $number = $row['contactnumber'];

        $query = "INSERT INTO tbluser(username, password, type) VALUES('$number','12345678','$type');";
        $result = $conn -> query($query);

        /* getting the user id for resident foreignkey */
        $uinfoquery = "SELECT * FROM tbluser WHERE username = '$number';";
        $uinforesult = $conn -> query($uinfoquery); 
        $uinforow = mysqli_fetch_array($uinforesult);

        $userid = $uinforow['id'];

        $query = "UPDATE resident_table
        SET user_id = '$userid'
        WHERE id = '$resID'";
        $result = $conn -> query($query);

        header("location:user_management.php");
    }
?>