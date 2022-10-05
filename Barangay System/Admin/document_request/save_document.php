<?php
    include("../../phpfiles/connection.php");
    
    if(isset($_POST['save']))
    {
        $id = $_POST['id'];
        $price = $_POST['price'];
        $availability = $_POST['av'];

        $query = "UPDATE document_type SET price = '$price', availability = '$availability' WHERE id = '$id';";
        $result = $conn -> query($query);
        header("location:document_request.php");
    }
?>