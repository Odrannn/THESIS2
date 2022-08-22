<?php
    if (isset($_POST['post']) && isset($_FILES['ann_image'])) {
        $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");

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
                $query = "INSERT INTO announcement (title, img_url, descrip)
                VALUES ('$title', '$new_img_name', '$description');";
                $result = $conn -> query($query);
            } else {
                echo "You can't upload files of this type.";
            }
        }

        header("location:announcement.php");
    } 
?>