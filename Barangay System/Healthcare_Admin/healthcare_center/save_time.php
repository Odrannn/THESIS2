<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['save']))
    {
        $time_start = $_POST['start'];
        $time_end = $_POST['end'];
        $query = "UPDATE healthcare_availability SET time_start = '$time_start', time_end = '$time_end' WHERE id = 1";
        $result = $conn -> query($query);
        header("location:healthcare_center.php");
    }
?>