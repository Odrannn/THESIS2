<?php
    include("../../phpfiles/connection.php");
    
    if(isset($_POST['add']))
    {
        $type = $_POST['type'];
        $price = $_POST['price'];

        $query = "INSERT INTO document_type(document_type, price) VALUE('$type', '$price');";
        $result = $conn -> query($query);

        header("location:document_request.php");
    }
?>