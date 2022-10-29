<?php
session_start();
$_SESSION["importUser"] = "";
include('../../phpfiles/connection.php');

$sql = "ALTER TABLE tblofficial
DROP CONSTRAINT ACCOUNT;";
$result = $conn -> query($sql);

$sql = "ALTER TABLE resident_table
DROP CONSTRAINT test;";
$result = $conn -> query($sql);

$sql = "DROP TABLE tbluser;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `tbluser` (
    `id` int(11) NOT NULL,
    `username` varchar(20) NOT NULL,
    `password` varchar(20) NOT NULL,
    `type` varchar(10) NOT NULL,
    `profile` varchar(100) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `tbluser` (`id`, `username`, `password`, `type`, `profile`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importUser"] = "success";
            } else {
                $_SESSION["importUser"] = "fail";
            }
        }
        
        $sql = "ALTER TABLE tbluser
        ADD PRIMARY KEY (`id`);

        ALTER TABLE tbluser
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;

        ALTER TABLE tblofficial
        ADD CONSTRAINT ACCOUNT
        FOREIGN KEY (user_id) REFERENCES tbluser(id);

        ALTER TABLE resident_table
        ADD CONSTRAINT test
        FOREIGN KEY (user_id) REFERENCES tbluser(id);";
        $result = $conn -> multi_query($sql);
    }
}
header("location:user_management.php");
?>