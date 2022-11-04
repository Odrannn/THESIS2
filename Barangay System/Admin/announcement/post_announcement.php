<?php
    session_start();
    date_default_timezone_set('Asia/Manila'); // SET TIMEZONE
    include("../../phpfiles/connection.php");
    $datetime = date("Y-m-d h:i:s");
    if (isset($_POST['post']) && isset($_FILES['ann_image'])) {
        echo "<pre>";
        print_r($_FILES['ann_image']);
        echo "<pre>";

        $img_name = $_FILES['ann_image']['name'];
        $img_size = $_FILES['ann_image']['size'];
        $tmp_name = $_FILES['ann_image']['tmp_name'];
        $error = $_FILES['ann_image']['error'];
        $title = $_POST['title'];
        $description = $_POST['description'];

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
                $img_upload_path = '../../announcement_uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert to db
                $query = "INSERT INTO announcement (title, img_url, descrip,date,status)
                VALUES ('$title', '$new_img_name', '$description' ,'$datetime', 'active');";
                $result = $conn -> query($query);
            } else {
                echo "You can't upload files of this type.";
            }
        }
        $_SESSION['message'] = 'Announcement successfully added.';
        $_SESSION['status'] = 1;

    } else if(isset($_POST['post'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        //insert to db
        $query = "INSERT INTO announcement (title, img_url, descrip, date, status)
        VALUES ('$title', 'default.jpg', '$description','$datetime', 'active');";
        $result = $conn -> query($query);

        $_SESSION['message'] = 'Announcement successfully added.';
        $_SESSION['status'] = 1;
    }
    header("location:announcement.php");
?>