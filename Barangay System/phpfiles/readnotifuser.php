<?php
include('connection.php');

$notifID = $_GET['notifid'];

$query = "SELECT * FROM user_notification WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);
$row = $result -> fetch_array();

$query = "UPDATE user_notification SET status ='1' WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);

if($row['notification_type']=="Requested Document on process"){
    header("location:../Residents/request_document/request_document.php");
} else if ($row['notification_type']=="Filed Complaint"){
    header("location:../Residents/file_case/file_complaint.php");
} else if ($row['notification_type']=="Sent Suggestion"){
    header("location:../Residents/file_case/send_suggestion/send_suggestion.php");
} else if ($row['notification_type']=="Filed Blotter"){
    header("location:../Residents/file_case/file_blotter/file_blotter.php");
}
?>