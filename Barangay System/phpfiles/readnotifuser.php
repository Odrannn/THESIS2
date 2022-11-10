<?php
include('connection.php');

$notifID = $_GET['notifid'];

$query = "SELECT * FROM user_notification WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);
$row = $result -> fetch_array();

$query = "UPDATE user_notification SET status ='1' WHERE notification_ID = '$notifID';";
$result = $conn -> query($query);

if($row['notification_type']=="Requested Document"){
    header("location:../Residents/request_document/view_requests.php");
} else if ($row['notification_type']=="Filed Complaint"){
    header("location:../Residents/file_case/view_complaints.php");
} else if ($row['notification_type']=="Sent Suggestion"){
    header("location:../Residents/file_case/send_suggestion/view_suggestions.php");
} else if ($row['notification_type']=="Filed Blotter"){
    header("location:../Residents/file_case/file_blotter/view_blotters.php");
}
?>