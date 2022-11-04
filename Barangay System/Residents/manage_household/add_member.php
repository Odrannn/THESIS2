<?php
session_start();
include("../../phpfiles/connection.php");

if(ISSET($_POST['add']))
{
    //update resident as a member of this household
    $residentID = $_POST['id'];
    $householdID = $_POST['householdID'];
    $query = "UPDATE resident_table SET household_ID = '$householdID' WHERE id = $residentID";
    $result = $conn -> query($query);

    //update member counts
    //count the number of resident that belongs to this household
    $query = "SELECT COUNT(id) FROM resident_table WHERE household_ID = '$householdID'";
    $result = $conn -> query($query);
    $row = $result -> fetch_array();
    $totalMembers = $row[0];

    //update household table
    $query = "UPDATE tblhousehold SET household_member = '$totalMembers' WHERE household_id = '$householdID'";
    $result = $conn -> query($query);

    $_SESSION['message'] = 'Resident successfully added to this household!';

    header("location:manage_household.php");
}
?>