<?php
session_start();
$_SESSION["importAnn"] = "";
include('../../phpfiles/connection.php');


$sql = "DROP TABLE announcement;";
$result = $conn -> query($sql);

$sql = "CREATE TABLE `announcement` (
    `id` int(11) NOT NULL,
    `title` varchar(100) NOT NULL,
    `img_url` varchar(100) NOT NULL,
    `descrip` varchar(200) NOT NULL,
    `status` varchar(20) NOT NULL
  );";
$result = $conn -> query($sql);

if(isset($_POST["import"])){
    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");
        

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $sqlInsert = "INSERT INTO `announcement` (`id`, `title`, `img_url`, `descrip`, `status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "')";

            $result = $conn -> query($sqlInsert);

            if(!empty($result)){
                $_SESSION["importAnn"] = "success";
            } else {
                $_SESSION["importAnn"] = "fail";
            }
        }
        
        $sql = "ALTER TABLE announcement
        ADD PRIMARY KEY (`id`);

        ALTER TABLE announcement
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        COMMIT;";
        $result = $conn -> multi_query($sql);
    }
}
header("location:announcement.php");
?>