<?php
    include("../../phpfiles/connection.php");
    
    //check if id don't exists
    $query2 = "SELECT id FROM resident_table;";
    $result2 = $conn -> query($query2);
    $list = array();

    while($row2 = mysqli_fetch_array($result2)){
        $list[] = $row2[0];
    }

    print_r($list);

    if(isset($_POST['add']))
    {
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $reason = $_POST['reason'];
        $patient_id = $_POST['id'];

        if (in_array($patient_id, $list))
        {
            $query1 = "SELECT concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table WHERE id = '$patient_id';";
            $result1 = $conn -> query($query1);
            $row = $result1 -> fetch_array();

            $fullname = $row['Fullname'];

            $query = "INSERT INTO healthcare_logs(patient_id, fullname, date, time, reason)
            VALUES('$patient_id', '$fullname', '$date','$time','$reason')";
            $result = $conn -> query($query);
            header("location:healthcare_center.php");
        }
        else 
        {
            $query = "INSERT INTO healthcare_logs(patient_id, fullname, date, time, reason)
            VALUES('0', '$patient_id', '$date','$time','$reason')";
            $result = $conn -> query($query);
            header("location:healthcare_center.php");
        }
        
    }
?>