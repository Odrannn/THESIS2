<?php
session_start();
include("../../phpfiles/connection.php");

if(isset($_POST['end_term'])){
    $officialID = $_POST['id'];

    $query = "UPDATE tblofficial SET status = 'term ended' WHERE official_id = '$officialID';";
    $result = $conn -> query($query);

    $query = "SELECT user_id FROM tblofficial WHERE official_id = '$officialID';";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();
    $user_id = $row['user_id'];
    
    $query = "UPDATE tbluser SET type = 'user' WHERE id = '$user_id';";
    $result = $conn -> query($query);
    

    $_SESSION['OffMessage'] = "Official term ended!";
    $_SESSION['sOffMessage'] = 1;

    header("location:official_management.php");
}
?>