<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
    if(isset($_POST['add_purok']))
    {
        $purok = $_POST['purok'];
        $id = 0;
        include('address_field_list.php');
        while($row = $result -> fetch_array()){
            if($row['purok'] == ''){
                $id = $row['id'];
                break;
            }
        }
        if($id == 0){
            $query = "INSERT INTO address_fields (purok) VALUES ('$purok');";
        } else {
            $query = "UPDATE address_fields SET purok = '$purok' WHERE id = $id";
        }
        $result = $conn -> query($query);
        header("location:configuration.php");
    }

    if(isset($_POST['add_sitio']))
    {
        $sitio = $_POST['sitio'];
        $id = 0;
        include('address_field_list.php');
        while($row = $result -> fetch_array()){
            if($row['sitio'] == ''){
                $id = $row['id'];
                break;
            }
        }
        if($id == 0){
            $query = "INSERT INTO address_fields (sitio) VALUES ('$sitio');";
        } else {
            $query = "UPDATE address_fields SET sitio = '$sitio' WHERE id = $id";
        }
        $result = $conn -> query($query);
        header("location:configuration.php");
    }

    if(isset($_POST['add_street']))
    {
        $street = $_POST['street'];
        $id = 0;
        include('address_field_list.php');
        while($row = $result -> fetch_array()){
            if($row['street'] == ''){
                $id = $row['id'];
                break;
            }
        }
        if($id == 0){
            $query = "INSERT INTO address_fields (street) VALUES ('$street');";
        } else {
            $query = "UPDATE address_fields SET street = '$street' WHERE id = $id";
        }
        $result = $conn -> query($query);
        header("location:configuration.php");
    }

    if(isset($_POST['add_subdivision']))
    {
        $subdivision = $_POST['subdivision'];
        $id = 0;
        include('address_field_list.php');
        while($row = $result -> fetch_array()){
            if($row['subdivision'] == ''){
                $id = $row['id'];
                break;
            }
        }
        if($id == 0){
            $query = "INSERT INTO address_fields (subdivision) VALUES ('$subdivision');";
        } else {
            $query = "UPDATE address_fields SET subdivision = '$subdivision' WHERE id = $id";
        }
        $result = $conn -> query($query);
        header("location:configuration.php");
    }
?>