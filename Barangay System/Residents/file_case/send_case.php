<?php
    session_start();
    $_SESSION['suggestion_message'] = '';
    $_SESSION['complaint_message'] = '';

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
        header("location:send_suggestion/send_suggestion.php");
    } 
?>