<?php
session_start();
$_SESSION["importMessage"] = "";
include('../../phpfiles/connection.php');

if(isset($_POST["import"])){
    //household end fk
    $sql = "ALTER TABLE tblhousehold
    DROP CONSTRAINT HEAD;";
    $result = $conn -> query($sql);

    //household fk
    $sql = "ALTER TABLE resident_table
    DROP CONSTRAINT HOUSE;";
    $result = $conn -> query($sql);

    //user id fk
    $sql = "ALTER TABLE resident_table
    DROP CONSTRAINT test;";
    $result = $conn -> query($sql);

    //officials fk
    $sql = "ALTER TABLE tblofficial
    DROP CONSTRAINT residency;";
    $result = $conn -> query($sql);

    //complaint fk
    $sql = "ALTER TABLE complaint_table
    DROP CONSTRAINT SENDER;";
    $result = $conn -> query($sql);

    //suggestion fk
    $sql = "ALTER TABLE suggestion_table
    DROP CONSTRAINT RESIDENT;";
    $result = $conn -> query($sql);

    //blotter fk
    $sql = "ALTER TABLE blotter_table
    DROP CONSTRAINT COMPLAINEE;";
    $result = $conn -> query($sql);

    $sql = "ALTER TABLE blotter_table
    DROP CONSTRAINT COMPLAINANT;";
    $result = $conn -> query($sql);

    //request fk
    $sql = "ALTER TABLE document_request
    DROP CONSTRAINT RESIDENT_2;";
    $result = $conn -> query($sql);

    //drop resident table
    $sql = "DROP TABLE resident_table;";
    $result = $conn -> query($sql);

    $sql = "CREATE TABLE `resident_table` (
        `id` int(11) NOT NULL,
        `user_id` int(11) DEFAULT NULL,
        `fname` varchar(100) NOT NULL,
        `mname` varchar(100) NOT NULL,
        `lname` varchar(100) NOT NULL,
        `suffix` varchar(10) NOT NULL,
        `gender` varchar(10) NOT NULL,
        `birthplace` varchar(100) NOT NULL,
        `civilstatus` varchar(50) NOT NULL,
        `birthday` date NOT NULL,
        `household_ID` int(11) DEFAULT NULL,
        `unitnumber` int(50) NOT NULL,
        `purok` varchar(50) NOT NULL,
        `sitio` varchar(50) NOT NULL,
        `street` varchar(50) NOT NULL,
        `subdivision` varchar(50) NOT NULL,
        `contactnumber` varchar(50) DEFAULT NULL,
        `email` varchar(100) NOT NULL,
        `religion` varchar(100) NOT NULL,
        `occupation` varchar(100) NOT NULL,
        `education` varchar(100) NOT NULL,
        `nationality` varchar(100) NOT NULL,
        `disability` varchar(100) NOT NULL,
        `status` varchar(20) NOT NULL
      )";
    $result = $conn -> query($sql);


    $filename = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"]>0){
        $file = fopen($filename, "r");

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){

            $orgDate = $column[9];  
            $newDate = date("Y-m-d", strtotime($orgDate));  

            $sqlInsert = "INSERT INTO resident_table(id,user_id,fname,mname,lname,suffix,gender,birthplace,civilstatus,birthday,household_ID,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,education,nationality,disability,status)
            VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '". $column[4] . "', '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $column[8] . "', '" . $newDate . "', '" . $column[10] . "', '" 
             . $column[11] . "', '" . $column[12] . "', '" . $column[13] . "', '" . $column[14] . "', '". $column[15] . "', '" . $column[16] . "', '" . $column[17] . "', '" . $column[18] . "', '" . $column[19] . "', '" . $column[20] . "', '" . $column[21] . "', '"
             . $column[22] . "', '" . $column[23] . "')";

            $result = mysqli_query($conn, $sqlInsert);

            if(!empty($result)){
                $_SESSION["importMessage"] = "success";
            } else {
                $_SESSION["importMessage"] = "fail";
            }
        }
        $sql = "ALTER TABLE `resident_table`
        ADD PRIMARY KEY (`id`);

        ALTER TABLE `resident_table`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

        ALTER TABLE tblhousehold
        ADD CONSTRAINT HEAD
        FOREIGN KEY (household_head_ID) REFERENCES resident_table(id);
        
        UPDATE resident_table SET household_ID = NULL where household_ID = '0';
        
        ALTER TABLE resident_table
        ADD CONSTRAINT HOUSE
        FOREIGN KEY (household_ID) REFERENCES tblhousehold(household_id);
        
        ALTER TABLE resident_table
        ADD CONSTRAINT test
        FOREIGN KEY (user_id) REFERENCES tbluser(id);

        ALTER TABLE tblofficial
        ADD CONSTRAINT residency
        FOREIGN KEY (resident_id) REFERENCES resident_table(id);
        
        ALTER TABLE complaint_table
        ADD CONSTRAINT SENDER
        FOREIGN KEY (sender_ID) REFERENCES resident_table(id);
        
        ALTER TABLE suggestion_table
        ADD CONSTRAINT RESIDENT
        FOREIGN KEY (sender_ID) REFERENCES resident_table(id);
        
        ALTER TABLE blotter_table
        ADD CONSTRAINT COMPLAINANT
        FOREIGN KEY (complainant_ID) REFERENCES resident_table(id);

        ALTER TABLE blotter_table
        ADD CONSTRAINT COMPLAINEE
        FOREIGN KEY (complainee_ID) REFERENCES resident_table(id);
        
        ALTER TABLE document_request
        ADD CONSTRAINT RESIDENT_2
        FOREIGN KEY (resident_ID) REFERENCES resident_table(id);";

        $result = $conn -> multi_query($sql);
    }
}
header("location:resident_management.php");
?>