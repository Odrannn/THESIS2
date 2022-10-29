<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['delete_option']))
    {
        $id = $_POST['id'];
        $query = "UPDATE case_option SET complaint_nature = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:case_management.php");

    }

    if(isset($_POST['delete_nature']))
    {
        $id = $_POST['id'];
        $query = "UPDATE case_option SET suggestion_nature = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:case_management.php");

    }

?>