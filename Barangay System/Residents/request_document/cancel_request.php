<?php
session_start();
include('../../phpfiles/connection.php');

if(isset($_POST['cancel'])){
    $reqID = $_POST['req_id'];

    $query1 = "UPDATE document_request set status = 'cancelled' WHERE request_ID = '$reqID';";
    $result1 = $conn -> query($query1);

    $_SESSION['cancelReq'] = "Your request has been cancelled, the refund of your payment is on process. You will be notified thru website or sms notification once the refund has been sent. Thankyou!";
}
header('location:view_requests.php');
?>