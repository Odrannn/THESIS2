<?php
include("../../../phpfiles/connection.php"); 

if(isset($_POST['add']))
{
    $headID = $_POST['id'];

    $query = "SELECT * FROM resident_table WHERE id = '$headID';";
    $result = $conn -> query($query);
    $row = ($result -> fetch_array());

    $family_name = $row['lname'];

    $query = "INSERT INTO tblhousehold(household_head_ID, household_name, status) VALUES('$headID', '$family_name', 'active')";
    $result = $conn -> query($query);

    header("location:household_management.php");
}
?>