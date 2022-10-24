<?php
session_start();
$_SESSION["importRegistration"] = "";
include('../../../phpfiles/connection.php');


if(isset($_POST["import"])){

    $sql = "DROP TABLE registration;";
    $result = $conn -> query($sql);

    $sql = "CREATE TABLE `registration` (
        `id` int(11) NOT NULL,
        `fname` varchar(100) NOT NULL,
        `mname` varchar(100) NOT NULL,
        `lname` varchar(100) NOT NULL,
        `suffix` varchar(10) DEFAULT NULL,
        `gender` varchar(10) DEFAULT NULL,
        `birthplace` varchar(100) NOT NULL,
        `civilstatus` varchar(100) NOT NULL,
        `birthday` date NOT NULL,
        `unitnumber` int(11) NOT NULL,
        `purok` varchar(100) NOT NULL,
        `sitio` varchar(100) NOT NULL,
        `street` varchar(100) NOT NULL,
        `subdivision` varchar(100) NOT NULL,
        `contactnumber` varchar(20) DEFAULT NULL,
        `email` varchar(100) NOT NULL,
        `religion` varchar(100) NOT NULL,
        `occupation` varchar(100) NOT NULL,
        `educational` varchar(100) NOT NULL,
        `nationality` varchar(100) NOT NULL,
        `disability` varchar(100) NOT NULL,
        `status` varchar(50) DEFAULT NULL,
        `img_path` varchar(50) DEFAULT NULL
      );";
    $result = $conn -> query($sql);

    $filename = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){

            $orgDate = $column[8];  
            $newDate = date("Y-m-d", strtotime($orgDate));  

            $sqlInsert = "INSERT INTO registration(id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,status,img_path)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $newDate . "', '" . $column[9] . "', '" . $column[10] . "', '" 
             . $column[11] . "', '" . $column[12] . "', '" . $column[13] . "', '" . $column[14] . "', '". $column[15] . "', '" . $column[16] . "', '" . $column[17] . "', '" . $column[18] . "', '" . $column[19] . "', '" . $column[20] . "', '" . $column[21] . "', '"
             . $column[22] . "')";

            $result = mysqli_query($conn, $sqlInsert);

            if(!empty($result)){
                $_SESSION["importRegistration"] = "success";
            } else {
                $_SESSION["importRegistration"] = "fail";
            }
        }

        $sql = "ALTER TABLE `registration`
        ADD PRIMARY KEY (`id`);

        ALTER TABLE `registration`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:residency_application.php");
?>