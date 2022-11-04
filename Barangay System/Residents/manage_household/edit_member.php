<?php
session_start();
include("../../phpfiles/connection.php"); 

if(isset($_POST['confirm'])){
    $rid = $_POST['id'];
    $query = "UPDATE resident_table SET household_ID = NULL where id ='$rid';";
    $result = $conn -> query($query);

    $_SESSION['message'] = 'Resident successfully removed!';
}

header("location:manage_household.php")
?>