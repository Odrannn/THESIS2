<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");


    if(isset($_POST['delete_purok']))
    {
        $id = $_POST['id'];
        $query = "UPDATE address_fields SET purok = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:configuration.php");

    }

    if(isset($_POST['delete_sitio']))
    {
        $id = $_POST['id'];
        $query = "UPDATE address_fields SET sitio = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:configuration.php");
    }

    if(isset($_POST['delete_street']))
    {
        $id = $_POST['id'];
        $query = "UPDATE address_fields SET street = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:configuration.php");
    }

    if(isset($_POST['delete_subdivision']))
    {
        $id = $_POST['id'];
        $query = "UPDATE address_fields SET subdivision = '' WHERE id = $id;";
        $result = $conn -> query($query);
        header("location:configuration.php");
    }
?>