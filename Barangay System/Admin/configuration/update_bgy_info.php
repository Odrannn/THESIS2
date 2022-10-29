<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['BI_save']))
    {
        $bgy_name = $_POST['bgy_name'];
        $mission = $_POST['mission'];
        $vision = $_POST['vision'];
        $city = $_POST['city'];

        $query = "UPDATE bgy_info SET bgy_name = '$bgy_name', vision = '$vision', mission = '$mission', city= '$city' WHERE id = 1";
        $result = $conn -> query($query);
        header("location:configuration.php");
    }
?>