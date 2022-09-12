<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");

    if(isset($_POST['delete_option']))
    {
        $id = $_POST['id'];
        $query = "UPDATE case_option SET complaint_nature = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:case_management.php");

    }

?>