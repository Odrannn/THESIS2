<?php
    include("../../phpfiles/connection.php");
    
    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $reason = $_POST['reason'];

        $query = "UPDATE healthcare_logs SET reason = '$reason' WHERE id = '$id';";
        $result = $conn -> query($query);
        header("location:healthcare_center.php");
    }
?>