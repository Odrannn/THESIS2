<?php
session_start();
$_SESSION["importRequest"] = "";
include('../../phpfiles/connection.php');

//DROP document
$sql = "ALTER TABLE document_request
DROP CONSTRAINT NAME;";
$result = $conn -> query($sql);

//DROP OFFICIAL
$sql = "ALTER TABLE document_request
DROP CONSTRAINT OFFICIAL_2;";
$result = $conn -> query($sql);

//DROP RESIDENT
$sql = "ALTER TABLE document_request
DROP CONSTRAINT RESIDENT_2;";
$result = $conn -> query($sql);

$sql = "DROP TABLE document_request;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `document_request` (
    `request_ID` int(11) NOT NULL,
    `official_ID` int(11) DEFAULT NULL,
    `resident_ID` int(11) NOT NULL,
    `document_ID` int(11) DEFAULT NULL,
    `purpose` varchar(100) NOT NULL,
    `quantity` int(10) NOT NULL,
    `payment` varchar(50) NOT NULL,
    `request_date` date NOT NULL,
    `status` varchar(10) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        
        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `document_request` (`request_ID`, `official_ID`, `resident_ID`, `document_ID`, `purpose`, `quantity`, `payment`, `request_date`, `status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '". $column[6] . "', '" . $column[7] . "', '" . $column[8] ."')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importRequest"] = "success";
            } else {
                $_SESSION["importRequest"] = "fail";
            }
        }
        
        $sql = "UPDATE document_request SET official_ID = NULL where official_ID = '0';
        
        ALTER TABLE document_request
        ADD CONSTRAINT OFFICIAL_2
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE document_request
        ADD CONSTRAINT RESIDENT_2
        FOREIGN KEY (resident_ID) REFERENCES resident_table(id);

        ALTER TABLE document_request
        ADD CONSTRAINT NAME
        FOREIGN KEY (document_ID) REFERENCES document_type(id);

        ALTER TABLE document_request
        ADD PRIMARY KEY (`request_ID`);

        ALTER TABLE document_request
        MODIFY request_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:document_request.php");
?>