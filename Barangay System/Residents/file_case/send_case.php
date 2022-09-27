<?php
    session_start();


    if (isset($_POST['send_complaint'])) {
        include("../../phpfiles/connection.php");

        $img_name = $_FILES['comp_image']['name'];
        $img_size = $_FILES['comp_image']['size'];
        $tmp_name = $_FILES['comp_image']['tmp_name'];
        $error = $_FILES['comp_image']['error'];
        $senderID = $_SESSION['user_id'];
        $nature = $_POST['nature'];
        $description = $_POST['description'];
        $date = date("Y-m-d");

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
                VALUES ('$senderID','$nature', '$new_img_name', '$description', '$date', 'pending');";
                $result = $conn -> query($query);
            } else {
                echo "You can't upload files of this type.";
            }
        }

        header("location:file_complaint.php");
    } 
?>