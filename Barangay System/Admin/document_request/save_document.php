<?php
    include("../../phpfiles/connection.php");
    
    if(isset($_POST['save']))
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $price = $_POST['price'];

        $query = "UPDATE document_type SET document_type = '$type', price = '$price' WHERE id = '$id';";
        $result = $conn -> query($query);
        header("location:document_request.php");
    }
?>