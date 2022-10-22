<?php
session_start();
$_SESSION["importHousehold"] = "";
include('../../../phpfiles/connection.php');

$sql = "ALTER TABLE resident_table
DROP CONSTRAINT HOUSE;";
$result = $conn -> query($sql);

$sql = "DROP TABLE tblhousehold;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `tblhousehold` (
            `household_id` int(11) NOT NULL,
            `household_member` int(10) DEFAULT NULL,
            `household_head_ID` int(11) DEFAULT NULL,
            `household_name` varchar(50) NOT NULL,
            `status` varchar(10) NOT NULL
        );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO tblhousehold(household_id,household_member,household_head_ID,household_name,status)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importHousehold"] = "success";
            } else {
                $_SESSION["importHousehold"] = "fail";
            }
        }
        
        $sql = "ALTER TABLE tblhousehold
        ADD CONSTRAINT HEAD
        FOREIGN KEY (household_head_ID) REFERENCES resident_table(id);

        ALTER TABLE `tblhousehold`
        ADD PRIMARY KEY (`household_id`);

        ALTER TABLE `tblhousehold`
        MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;
        
        ALTER TABLE resident_table
        ADD CONSTRAINT HOUSE
        FOREIGN KEY (household_ID) REFERENCES tblhousehold(household_id);";
        $result = $conn -> multi_query($sql);
    }
}
header("location:household_management.php");
?>