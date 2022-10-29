<?php
session_start();
include("../../phpfiles/connection.php");

if(isset($_POST['end_term'])){
    $officialID = $_POST['id'];

    $query = "UPDATE tblofficial SET status = 'term ended', type = 'user' WHERE official_id = '$officialID';";
    $result = $conn -> query($query);

    $_SESSION['OffMessage'] = "Official term ended!";
    $_SESSION['sOffMessage'] = 1;

    header("location:official_management.php");
}
?>