<?php
include('connection.php');

$notifID = $_GET['notifid'];

$query = "SELECT * FROM admin_notification WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);
$row = $result -> fetch_array();

$query = "UPDATE admin_notification SET status ='1' WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);

if($row['notification_type']=="Request Document"){
    header("location:../Admin/document_request/document_request.php");
} else if ($row['notification_type']=="File Complaint"){
    header("location:../Admin/case_management/case_management.php");
} else if ($row['notification_type']=="Send Suggestion"){
    header("location:../Admin/case_management/suggestion_management/suggestion_management.php");
} else if ($row['notification_type']=="File Blotter"){
    header("location:../Admin/case_management/blotter_management/blotter_management.php");
}
?>