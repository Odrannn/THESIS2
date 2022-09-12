<?php
$conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    if(isset($_POST['add_option']))
    {
        $complaint = $_POST['complaint'];
        $id = 0;
        include('../../phpfiles/case_option.php');
        while($row = $result -> fetch_array()){
            if($row['complaint_nature'] == ''){
                $id = $row['id'];
                break;
            }
        }
        if($id == 0){
            $query = "INSERT INTO case_option (complaint_nature) VALUES ('$complaint');";
        } else {
            $query = "UPDATE case_option SET complaint_nature = '$complaint' WHERE id = $id";
        }
        $result = $conn -> query($query);
        header("location:case_management.php");
    }
?>