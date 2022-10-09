<?php
include("../../../phpfiles/connection.php"); 

if(isset($_POST['chin']))
{
    $householdid = $_POST['id'];
    $query = "UPDATE tblhousehold SET status = 'inactive' WHERE household_id = '$householdid'";
    $result = $conn -> query($query);

    $query = "UPDATE resident_table SET household_ID = null WHERE household_ID = '$householdid'";
    $result = $conn -> query($query);

    header("location:household_management.php");
}

?>