<?php
session_start();
$_SESSION["importBlotter"] = "";
include('../../../phpfiles/connection.php');

//DROP OFFICIAL
$sql = "ALTER TABLE blotter_table
DROP CONSTRAINT OFFICIAL_IG;";
$result = $conn -> query($sql);

//DROP RESIDENT
$sql = "ALTER TABLE blotter_table
DROP CONSTRAINT COMPLAINANT;";
$result = $conn -> query($sql);

//DROP complainee
$sql = "ALTER TABLE blotter_table
DROP CONSTRAINT COMPLAINEE;";
$result = $conn -> query($sql);

$sql = "DROP TABLE blotter_table;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `blotter_table` (
    `blotter_ID` int(11) NOT NULL,
    `official_ID` int(11) DEFAULT NULL,
    `complainant_ID` int(11) NOT NULL,
    `complainee_ID` int(11) DEFAULT NULL,
    `complainee_name` varchar(100) NOT NULL,
    `blotter_date` date NOT NULL,
    `blotter_time` time NOT NULL,
    `blotter_accusation` varchar(50) NOT NULL,
    `blotter_details` varchar(100) NOT NULL,
    `settlement_schedule` date NOT NULL,
    `settlement_time` time DEFAULT NULL,
    `result_of_settlement` varchar(100) NOT NULL,
    `status` varchar(20) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        
        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `blotter_table` (`blotter_ID`, `official_ID`, `complainant_ID`, `complainee_ID`, `complainee_name`, `blotter_date`, `blotter_time`, `blotter_accusation`, `blotter_details`, `settlement_schedule`, `settlement_time`, `result_of_settlement`, `status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '". $column[6] . "', '" . $column[7] . "', '". $column[8] . "', '" . $column[9] . "', '". $column[10] . "', '" . $column[11] . "', '" . $column[12] ."')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importBlotter"] = "success";
            } else {
                $_SESSION["importBlotter"] = "fail";
            }
        }
        
        $sql = "UPDATE blotter_table SET official_ID = NULL where official_ID = '0';
        UPDATE blotter_table SET complainee_ID = NULL where complainee_ID = '0';
        
        ALTER TABLE blotter_table
        ADD CONSTRAINT OFFICIAL_IG
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE blotter_table
        ADD CONSTRAINT COMPLAINANT
        FOREIGN KEY (complainant_ID) REFERENCES resident_table(id);

        ALTER TABLE blotter_table
        ADD CONSTRAINT COMPLAINEE
        FOREIGN KEY (complainee_ID) REFERENCES resident_table(id);

        ALTER TABLE blotter_table
        ADD PRIMARY KEY (`blotter_ID`);

        ALTER TABLE blotter_table
        MODIFY blotter_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:blotter_management.php");
?>