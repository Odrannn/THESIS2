<?php
session_start();
$_SESSION["importSuggestion"] = "";
include('../../../phpfiles/connection.php');

//DROP OFFICIAL
$sql = "ALTER TABLE suggestion_table
DROP CONSTRAINT OFFICIAL;";
$result = $conn -> query($sql);

//DROP RESIDENT
$sql = "ALTER TABLE suggestion_table
DROP CONSTRAINT RESIDENT;";
$result = $conn -> query($sql);

$sql = "DROP TABLE suggestion_table;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `suggestion_table` (
    `suggestion_ID` int(11) NOT NULL,
    `official_ID` int(11) DEFAULT NULL,
    `sender_ID` int(11) NOT NULL,
    `suggestion_nature` varchar(50) NOT NULL,
    `suggestion_desc` varchar(100) NOT NULL,
    `suggestion_date` date NOT NULL,
    `suggestion_feedback` varchar(100) NOT NULL,
    `suggestion_status` varchar(10) DEFAULT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        
        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `suggestion_table` (`suggestion_ID`, `official_ID`, `sender_ID`, `suggestion_nature`, `suggestion_desc`, `suggestion_date`, `suggestion_feedback`, `suggestion_status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '". $column[6] . "', '" . $column[7] ."')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importSuggestion"] = "success";
            } else {
                $_SESSION["importSuggestion"] = "fail";
            }
        }
        
        $sql = "UPDATE suggestion_table SET official_ID = NULL where official_ID = '0';
        
        ALTER TABLE suggestion_table
        ADD CONSTRAINT OFFICIAL
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE suggestion_table
        ADD CONSTRAINT RESIDENT
        FOREIGN KEY (sender_ID) REFERENCES resident_table(id);

        ALTER TABLE suggestion_table
        ADD PRIMARY KEY (`suggestion_ID`);

        ALTER TABLE suggestion_table
        MODIFY suggestion_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:suggestion_management.php");
?>