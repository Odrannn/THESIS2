<?php
    include("../../phpfiles/connection.php");
    /* getting existing resident from official table*/
    $exquery = "SELECT resident_id FROM tblofficial;";
    $exresult = $conn -> query($exquery); 

    /* getting existing resident from resident table*/
    $requery = "SELECT id FROM resident_table;";
    $reresult = $conn -> query($requery); 

    $residentID = $_POST['residentID'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];

    $off = array();
    $re = array();


    while($exrow = mysqli_fetch_array($exresult)){
        $off[] = $exrow[0];
    }

    while($rerow = mysqli_fetch_array($reresult)){
        $re[] = $rerow[0];
    }

    if (in_array($residentID , $re) && !in_array($residentID , $off)){
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

        header("location:official_management.php");
        
        
    } else {
        echo "resident is already an official or not a resident";
    }
?>