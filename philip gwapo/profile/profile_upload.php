<?php
	session_start();
	
    if (isset($_POST['submit']) && isset($_FILES['ann_image'])) {
        include("../../phpfiles/connection.php");

        $img_name = $_FILES['ann_image']['name'];
        $img_size = $_FILES['ann_image']['size'];
        $tmp_name = $_FILES['ann_image']['tmp_name'];
        $error = $_FILES['ann_image']['error'];

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
                $img_upload_path = '../../Admin/resident_management/residentimages/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert to db
                $query = "UPDATE tbluser SET profile='$new_img_name' where id = '" . $_SESSION['user_id'] . "'";
                $result = $conn -> query($query);
				echo $img_ex_lc . "\n";
            } else {
                echo "You can't upload files of this type.";
            }
        }

	header("location: profile.php");
    } 
?>