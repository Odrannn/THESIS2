<?php
session_start();
$_SESSION["importhlog"] = "";
include('../../phpfiles/connection.php');

$sql = "DROP TABLE healthcare_logs;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `healthcare_logs` (
    `id` int(11) NOT NULL,
    `patient_id` int(11) DEFAULT NULL,
    `fullname` varchar(100) DEFAULT NULL,
    `date` date NOT NULL,
    `time` time NOT NULL,
    `reason` varchar(100) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        
        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `healthcare_logs` (`id`, `patient_id`, `fullname`, `date`, `time`, `reason`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importhlog"] = "success";
            } else {
                $_SESSION["importhlog"] = "fail";
            }
        }
        
        $sql = "ALTER TABLE healthcare_logs
        ADD PRIMARY KEY (`id`);

        ALTER TABLE healthcare_logs
        MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:healthcare_center.php");
?>