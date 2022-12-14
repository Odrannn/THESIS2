<?php
session_start();
include('../../phpfiles/connection.php');

$senderID = $_SESSION['user_id'];
$query = "SELECT id FROM resident_table WHERE user_id = '$senderID';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();
$resident_id = $row['id'];

if(isset($_POST['payment'])){
    $reqID = $_POST['req_id'];

    $img_name = $_FILES['proof']['name'];
    $img_size = $_FILES['proof']['size'];
    $tmp_name = $_FILES['proof']['tmp_name'];
    $error = $_FILES['proof']['error'];
        

    if ($error === 0) {
        if ($img_size > 125000) {
            $_SESSION['paymentMessage'] =  "Sorry, your file is too large.";
        }
        else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("RCPT-", true).'.'.$img_ex_lc;
                $img_upload_path = '../../request_uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //update db
                $query = "UPDATE document_request set status = 'pending for verification', payment = '$new_img_name'  WHERE request_ID = '$reqID';";
                $result = $conn -> query($query);

                $_SESSION['paymentMessage'] = "Your payment has been successfully sent.
                    Please wait patiently, your request is in process. You can monitor its status in the tracking section or check your notification for updates.";
                
                $date1 = date('y-m-d h:i:s');
                $query = "INSERT INTO admin_notification(notification_type, type_ID, message, source_ID, date_time, status)
                VALUES ('Request Document',$reqID,'sent a payment.','$resident_id','$date1','0');";
                $result = $conn -> query($query);
            } else {
                $_SESSION['paymentMessage'] = "You can't upload files of this type.";
                $_SESSION['error_type'] = 'error';
            }
        }
    } else {
        $_SESSION['paymentMessage'] = "You can't upload files of this type.";
        $_SESSION['error_type'] = 'error';
    }
}
header('location:view_requests.php');
?>