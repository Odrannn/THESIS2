<?php
session_start();
$_SESSION["importMessage"] = "";
include('../../phpfiles/connection.php');

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO resident_table(id,user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,household_ID,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $column[8] . "', '" . $column[9] . "', '" . $column[10] . "', '" 
             . $column[11] . "', '" . $column[12] . "', '" . $column[13] . "', '" . $column[14] . "', '". $column[15] . "', '" . $column[16] . "', '" . $column[17] . "', '" . $column[18] . "', '" . $column[19] . "', '" . $column[20] . "', '" . $column[21] . "', '"
             . $column[22] . "', '" . $column[23] . "')";

            $result = mysqli_query($conn, $sqlInsert);

            if(!empty($result)){
                $_SESSION["importMessage"] = "success";
            } else {
                $_SESSION["importMessage"] = "fail";
            }
        }
    }
}
header("location:resident_management.php");
?>