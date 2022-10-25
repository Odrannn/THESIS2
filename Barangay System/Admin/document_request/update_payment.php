<?php
include("../../phpfiles/connection.php");
session_start();

if(isset($_POST['save_info'])){
    $gname = $_POST['gname'];
    $gnum = $_POST['gnum'];

    $query = "UPDATE payment_info SET g_name = '$gname', cp_number = '$gnum';";
    $result = $conn -> query($query);

    $_SESSION['pinfoMessage'] = 1;
}

header("location:document_request.php");

?>