<?php
    session_start();
    include("../../phpfiles/connection.php");
    if(isset($_POST['save']))
    {
        $prime = $_POST['prime'];
        $query = "UPDATE bgy_info SET color_theme = '$prime' WHERE id = 1";
        $result = $conn -> query($query);
        
        $_SESSION['message'] = "Primary color successfully changed.";
        $_SESSION['status'] = "1";
        header("location:configuration.php");
    }
?>