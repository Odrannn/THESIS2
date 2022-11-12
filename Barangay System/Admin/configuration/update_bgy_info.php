<?php
    session_start();
    include("../../phpfiles/connection.php");
    if(isset($_POST['BI_save']))
    {
        $bgy_name = $_POST['bgy_name'];
        $mission = $_POST['mission'];
        $vision = $_POST['vision'];
        $city = $_POST['city'];
        $telephone = $_POST['tp_number'];
        $bgy_email = $_POST['bgy_email'];

        $query = "UPDATE bgy_info SET bgy_name = '$bgy_name', vision = '$vision', mission = '$mission', city= '$city', telephone_number = '$telephone', bgy_email ='$bgy_email' WHERE id = 1";
        $result = $conn -> query($query);

        $_SESSION['message'] = "Barangay information successfully updated.";
        $_SESSION['status'] = "1";
        header("location:configuration.php");
    }
?>