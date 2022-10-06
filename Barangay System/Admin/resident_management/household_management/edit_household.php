<?php
include("../../../phpfiles/connection.php"); 

if(isset($_POST['chin']))
{
    $householdid = $_POST['id'];
    $query = "UPDATE tblhousehold SET status = 'inactive' WHERE household_id = '$householdid'";
    $result = $conn -> query($query);

    header("location:household_management.php");
}

if(isset($_POST['chac']))
{
    $householdid = $_POST['id'];
    $query = "UPDATE tblhousehold SET status = 'active' WHERE household_id = '$householdid'";
    $result = $conn -> query($query);

    header("location:household_management.php");
}
?>