<?php
session_start();
$_SESSION["importOfficial"] = "";
include('../../phpfiles/connection.php');

if(isset($_POST["import"])){
    //user id fk
    $sql = "ALTER TABLE tblofficial
    DROP CONSTRAINT ACCOUNT;";
    $result = $conn -> query($sql);

    //RESIDENT fk
    $sql = "ALTER TABLE tblofficial
    DROP CONSTRAINT residency;";
    $result = $conn -> query($sql);

    //complaint fk
    $sql = "ALTER TABLE complaint_table
    DROP CONSTRAINT INCHARGE;";
    $result = $conn -> query($sql);

    //suggestion fk
    $sql = "ALTER TABLE suggestion_table
    DROP CONSTRAINT OFFICIAL;";
    $result = $conn -> query($sql);

    //blotter fk
    $sql = "ALTER TABLE blotter_table
    DROP CONSTRAINT OFFICIAL_IG;";
    $result = $conn -> query($sql);

    //request fk
    $sql = "ALTER TABLE document_request
    DROP CONSTRAINT OFFICIAL_2;";
    $result = $conn -> query($sql);

    //notif fk
    $sql = "ALTER TABLE user_notification
    DROP CONSTRAINT OFFICIAL_3;";
    $result = $conn -> query($sql);

    //drop officials table
    $sql = "DROP TABLE tblofficial;";
    $result = $conn -> query($sql);

    $sql = "CREATE TABLE `tblofficial` (
        `official_id` int(11) NOT NULL,
        `resident_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `name` varchar(50) NOT NULL,
        `position` varchar(30) NOT NULL,
        `term_start` date NOT NULL,
        `term_end` date NOT NULL,
        `status` text NOT NULL
      )";
    $result = $conn -> query($sql);


    $filename = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){

            $sqlInsert = "INSERT INTO `tblofficial` (`official_id`, `resident_id`, `user_id`, `name`, `position`, `term_start`, `term_end`, `status`)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "')";

            $result = mysqli_query($conn, $sqlInsert);

            if(!empty($result)){
                $_SESSION["importOfficial"] = "success";
            } else {
                $_SESSION["importOfficial"] = "fail";
            }
        }
        $sql = "ALTER TABLE `tblofficial`
        ADD PRIMARY KEY (`official_id`);

        ALTER TABLE `tblofficial`
        MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

        ALTER TABLE tblofficial
        ADD CONSTRAINT residency
        FOREIGN KEY (resident_id) REFERENCES resident_table(id);
        
        ALTER TABLE tblofficial
        ADD CONSTRAINT ACCOUNT
        FOREIGN KEY (user_id) REFERENCES tbluser(id);
        
        ALTER TABLE complaint_table
        ADD CONSTRAINT INCHARGE
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);
        
        ALTER TABLE suggestion_table
        ADD CONSTRAINT OFFICIAL
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE blotter_table
        ADD CONSTRAINT OFFICIAL_IG
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE document_request
        ADD CONSTRAINT OFFICIAL_2
        FOREIGN KEY (official_ID) REFERENCES tblofficial(official_id);

        ALTER TABLE user_notification
        ADD CONSTRAINT OFFICIAL_3
        FOREIGN KEY (source_ID) REFERENCES tblofficial(official_id);";

        $result = $conn -> multi_query($sql);
    }
}
header("location:official_management.php");
?>