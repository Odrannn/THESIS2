<?php
    include("../../phpfiles/connection.php");

    $response = array(
        'status' => 0,
        'message' => 'Form submission Failed');

    
    $resID = $_POST['id'];
    $type = $_POST['type'];
    $uname = $_POST['uname'];
    $userpassword = date("Y").time();

    //getting existing number 
    $exquery = "SELECT * FROM tbluser WHERE username = '$uname';";
    $exresult = $conn -> query($exquery); 

    //getting existing number 
    $exquery2 = "SELECT * FROM resident_table WHERE id = '$resID';";
    $exresult2 = $conn -> query($exquery2); 

    if (mysqli_num_rows($exresult2)==0){
        $response['message'] = "Resident doesn't exists.";
    }else if (mysqli_num_rows($exresult)>0){
        $response['message'] = "Username already exists.";
    } else {
        $query = "INSERT INTO tbluser(username, password, type, status, profile) VALUES('$uname','$userpassword','$type', 'active', 'default.jpg');";
        $result = $conn -> query($query);

        /* getting the user id for resident foreignkey */
        $uinfoquery = "SELECT * FROM tbluser WHERE username = '$uname';";
        $uinforesult = $conn -> query($uinfoquery); 
        $uinforow = mysqli_fetch_array($uinforesult);

        $userid = $uinforow['id'];

        $query = "UPDATE resident_table
        SET user_id = '$userid'
        WHERE id = '$resID'";
        $result = $conn -> query($query);

        $response['message'] = "Account successfully added to User Record";
        $response['status'] = 1;
    }
    echo json_encode($response);
?>