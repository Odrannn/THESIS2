<?php
    if (isset($_POST['upload']) && isset($_FILES['logo']) || isset($_FILES['background'])) {
        include("../../phpfiles/connection.php");
        echo "<pre>";
        print_r($_FILES['logo']);
        echo "<pre>";

        $img_name = $_FILES['logo']['name'];
        $img_size = $_FILES['logo']['size'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $error = $_FILES['logo']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert to db
                $query = "UPDATE bgy_info SET logo_url = '$new_img_name' WHERE id = 1";
                $result = $conn -> query($query);
                echo $img_ex_lc . "\n";
            } else {
                echo "You can't upload files of this type.";
            }
        }

        echo "<pre>";
        print_r($_FILES['background']);
        echo "<pre>";

        $img_name = $_FILES['background']['name'];
        $img_size = $_FILES['background']['size'];
        $tmp_name = $_FILES['background']['tmp_name'];
        $error = $_FILES['background']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../../Login/images/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert to db
                $query = "UPDATE bgy_info SET background_url = '$new_img_name' WHERE id = 1";
                $result = $conn -> query($query);
                echo $img_ex_lc . "\n";
            } else {
                echo "You can't upload files of this type.";
            }
        }
        header("location:configuration.php");
    } 
    
?>