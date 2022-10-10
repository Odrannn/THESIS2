<?php
    session_start();
    $_SESSION['request_message'] = '';
    $_SESSION['error_type'] = 'success';

    include("../../phpfiles/connection.php");
    $senderID = $_SESSION['user_id'];
    $query = "SELECT id FROM resident_table WHERE user_id = '$senderID';";
    $result = $conn -> query($query);
    $row = $result->fetch_assoc();
    $resident_id = $row['id'];

    if (isset($_POST['submit_request'])) {
        $type = $_POST['doc_type'];
        $quantity = $_POST['quantity'];
        $purpose = $_POST['purpose'];
        $date = date("Y-m-d");

        $img_name = $_FILES['proof']['name'];
        $img_size = $_FILES['proof']['size'];
        $tmp_name = $_FILES['proof']['tmp_name'];
        $error = $_FILES['proof']['error'];
        

        if ($error === 0) {
            /*if ($img_size > 125000) {
                echo "Sorry, your file is too large.";
            }
            else {*/
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("RCPT-", true).'.'.$img_ex_lc;
                $img_upload_path = '../../request_uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert to db
                $query = "INSERT INTO document_request(resident_ID, document_ID, purpose, quantity, payment, request_date, status)
                VALUES ('$resident_id','$type', '$purpose', '$quantity', '$new_img_name', '$date', 'pending');";
                $result = $conn -> query($query);

                $_SESSION['request_message'] = "Your request has been successfully submitted.
                    Please wait patiently, your request is in process. You can monitor its status in the tracking section or check your notification for updates.";
                
                //get the recent request ID
                $query = "SELECT request_ID FROM document_request
                WHERE request_ID = (SELECT MAX(request_ID) FROM document_request);";
                $result = $conn -> query($query);
                $row = $result -> fetch_array();
                $reqID = $row[0];

                $date1 = date('y-m-d h:i:s');
                $query = "INSERT INTO admin_notification(notification_type, type_ID, message, source_ID, date_time, status)
                VALUES ('Request Document',$reqID,'requested a document.','$resident_id','$date1','0');";
                $result = $conn -> query($query);
            } else {
                $_SESSION['request_message'] = "You can't upload files of this type.";
                $_SESSION['error_type'] = 'error';
            }
        } else {
            $_SESSION['request_message'] = "You can't upload files of this type.";
            $_SESSION['error_type'] = 'error';
        }
        header("location:request_document.php");
    } 
?>

