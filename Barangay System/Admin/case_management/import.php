<?php
session_start();
$_SESSION["importComplaint"] = "";
include('../../phpfiles/connection.php');

//DROP OFFICIAL
$sql = "ALTER TABLE complaint_table
DROP CONSTRAINT INCHARGE;";
$result = $conn -> query($sql);

//DROP RESIDENT
$sql = "ALTER TABLE complaint_table
DROP CONSTRAINT SENDER;";
$result = $conn -> query($sql);

$sql = "DROP TABLE complaint_table;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `complaint_table` (
    `complaint_ID` int(11) NOT NULL,
    `official_ID` int(11) DEFAULT NULL,
    `sender_ID` int(11) NOT NULL,
    `complaint_nature` varchar(20) NOT NULL,
    `comp_desc` varchar(100) NOT NULL,
    `complaint_date` date NOT NULL,
    `img_proof` varchar(50) NOT NULL,
    `complaint_status` varchar(20) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `complaint_table` (`complaint_ID`, `official_ID`, `sender_ID`, `complaint_nature`, `comp_desc`, `complaint_date`, `img_proof`, `complaint_status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '". $column[6] . "', '" . $column[7] ."')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importComplaint"] = "success";
            } else {
                $_SESSION["importComplaint"] = "fail";
            }
        }
        
        $sql = "UPDATE complaint_table SET official_ID = NULL where official_ID = '0';
        
        ALTER TABLE complaint_table
        ADD CONSTRAINT INCHARGE
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE complaint_table
        ADD CONSTRAINT SENDER
        FOREIGN KEY (sender_ID) REFERENCES resident_table(id);

        ALTER TABLE complaint_table
        ADD PRIMARY KEY (`complaint_ID`);

        ALTER TABLE complaint_table
        MODIFY complaint_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:case_management.php");
?>