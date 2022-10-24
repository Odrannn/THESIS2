<?php
    session_start();
    $_SESSION['suggestion_message'] = '';
    $_SESSION['complaint_message'] = '';
    $_SESSION['blotter_message'] = '';

    include("../../phpfiles/connection.php");
    $senderID = $_SESSION['user_id'];
    $query = "SELECT id FROM resident_table WHERE user_id = '$senderID';";
    $result = $conn -> query($query);
    $row = $result->fetch_assoc();
    $resident_id = $row['id'];

    if (isset($_POST['send_complaint'])) {

        $nature = $_POST['nature'];
        $description = $_POST['description'];
        $date = date("Y-m-d");

        if (isset($_FILES['comp_image'])) {
            $img_name = $_FILES['comp_image']['name'];
            $img_size = $_FILES['comp_image']['size'];
            $tmp_name = $_FILES['comp_image']['tmp_name'];
            $error = $_FILES['comp_image']['error'];
            

            if ($error === 0) {
                /*if ($img_size > 125000) {
                    echo "Sorry, your file is too large.";
                }
                else {*/
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../../complaint_uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    //insert to db
                    $query = "INSERT INTO complaint_table(sender_ID, complaint_nature, img_proof, comp_desc, complaint_date,complaint_status)
                    VALUES ('$resident_id','$nature', '$new_img_name', '$description', '$date', 'pending');";
                    $result = $conn -> query($query);
                } else {
                    echo "You can't upload files of this type.";
                }
            }
        } else {
            $query = "INSERT INTO complaint_table(sender_ID, complaint_nature, comp_desc, complaint_date,complaint_status)
            VALUES ('$resident_id','$nature', '$description', '$date', 'pending');";
            $result = $conn -> query($query);
        }
        $_SESSION['complaint_message'] = "Your complaint has been successfully submitted.
        Please wait patiently, your case is in process. You can monitor its status in the tracking menu or check your notification for updates.";
        
        //get the recent complaint ID
        $query = "SELECT complaint_ID FROM complaint_table
        WHERE complaint_ID = (SELECT MAX(complaint_ID) FROM complaint_table);";
        $result = $conn -> query($query);
        $row = $result -> fetch_array();
        $compID = $row[0];

        $date1 = date('y-m-d h:i:s');
        $query = "INSERT INTO admin_notification(notification_type, type_ID, message, source_ID, date_time, status)
        VALUES ('File Complaint',$compID,'filed a complaint.','$resident_id','$date1','0');";
        $result = $conn -> query($query);
        header("location:file_complaint.php");
    } 

    if (isset($_POST['send_suggestion'])) {
        $nature = $_POST['nature'];
        $description = $_POST['description'];
        $date = date("Y-m-d");
        
        $query = "INSERT INTO suggestion_table(sender_ID, suggestion_nature, suggestion_desc, suggestion_date, suggestion_status)
        VALUES ('$resident_id','$nature', '$description', '$date', 'pending');";
        $result = $conn -> query($query);
        
        $_SESSION['suggestion_message'] = "Your suggestion has been successfully submitted.
        Please wait patiently, your case is in process. You can monitor its status in the tracking section or check your notification for updates.";
        
        //get the recent suggestion ID
        $query = "SELECT suggestion_ID FROM suggestion_table
        WHERE suggestion_ID = (SELECT MAX(suggestion_ID) FROM suggestion_table);";
        $result = $conn -> query($query);
        $row = $result -> fetch_array();
        $compID = $row[0];

        $date1 = date('y-m-d h:i:s');
        $query = "INSERT INTO admin_notification(notification_type, type_ID, message, source_ID, date_time, status)
        VALUES ('Send Suggestion',$compID,'sent a suggestion.','$resident_id','$date1','0');";
        $result = $conn -> query($query);
        header("location:send_suggestion/send_suggestion.php");
    } 

    if (isset($_POST['send_blotter'])) {
        $complaineeID = $_POST['complaineeID'];
        $accusation = $_POST['accusation'];
        $details = $_POST['details'];
        $date = $_POST['dateh'];
        $time = $_POST['timeh'];
        
        $exquery = "SELECT * FROM resident_table WHERE id='$complaineeID';";
        $exresult = $conn -> query($exquery); 

        if (mysqli_num_rows($exresult)>0){
            $query1 = "SELECT concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table WHERE id = '$complaineeID';";
            $result1 = $conn -> query($query1);
            $row = $result1 -> fetch_array();

            $fullname = $row['Fullname'];

            $query = "INSERT INTO blotter_table(complainant_ID, complainee_ID, complainee_name, blotter_accusation, blotter_details, blotter_date, blotter_time, status)
            VALUES ('$resident_id','$complaineeID','$fullname', '$accusation', '$details', '$date', '$time', 'unscheduled');";
            $result = $conn -> query($query);
        } else {
            $query = "INSERT INTO blotter_table(complainant_ID, complainee_ID, complainee_name, blotter_accusation, blotter_details, blotter_date, blotter_time, status)
            VALUES ('$resident_id','0','$complaineeID', '$accusation', '$details', '$date', '$time', 'unscheduled');";
            $result = $conn -> query($query);
        }
        
        $_SESSION['blotter_message'] = "Your blotter has been successfully submitted.
        Please wait patiently, your case is in process. You can monitor its status in the tracking section or check your notification for updates.";

        //get the recent blotter ID
        $query = "SELECT blotter_ID FROM blotter_table
        WHERE blotter_ID = (SELECT MAX(blotter_ID) FROM blotter_table);";
        $result = $conn -> query($query);
        $row = $result -> fetch_array();
        $compID = $row[0];

        $date1 = date('y-m-d h:i:s');
        $query = "INSERT INTO admin_notification(notification_type, type_ID, message, source_ID, date_time, status)
        VALUES ('File Blotter',$compID,'filed a blotter.','$resident_id','$date1','0');";
        $result = $conn -> query($query);

        $query = "UPDATE blotter_table SET complainee_ID = NULL where complainee_ID = '0';";
        $result = $conn -> query($query);
        header("location:file_blotter/file_blotter.php");
    } 
?>

