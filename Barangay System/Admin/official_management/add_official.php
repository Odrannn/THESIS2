<?php
    session_start();
    include("../../phpfiles/connection.php");

    if(isset($_POST['add_official']) && $_POST['add_official'] != ''){
        $residentID = $_POST['residentID'];
        $position = $_POST['position'];
        $term_start = $_POST['term_start'];
        $term_end = $_POST['term_end'];

        //validate if resident existing
        $exquery2 = "SELECT * FROM resident_table WHERE id = '$residentID';";
        $exresult2 = $conn -> query($exquery2); 

        if (mysqli_num_rows($exresult2)==0){
            $_SESSION['OffMessage'] = "Resident doesn't exists.";
            $_SESSION['sOffMessage'] = 0;
        } else {
            /* get resident info */
            $query = "SELECT * FROM resident_table WHERE id = $residentID;";
            $result = $conn -> query($query); 
            $row = mysqli_fetch_array($result);

            $name = $row['fname'] . " " .  $row['mname'] . " " . $row['lname'];
            $userid = $row['user_id'];
            
            echo $name;
            echo $userid;

            /* official creation query */
            $query = "INSERT INTO tblofficial(resident_id, user_id, name, position, term_start, term_end, status)
            VALUES('$residentID','$userid','$name','$position','$term_start','$term_end','active')";
            $result = $conn -> query($query);

            /* update account */
            if($position == 'Chairman'){
                $query = "UPDATE tbluser SET type = 'admin0' WHERE id = '$userid'";
                $result = $conn -> query($query);
            } else {
                $query = "UPDATE tbluser SET type = 'admin' WHERE id = '$userid'";
                $result = $conn -> query($query);
            }
            
            $_SESSION['OffMessage'] = "Official Successfully added!";
            $_SESSION['sOffMessage'] = 1;
            
        }   
        header("location:official_management.php");
    }
?>