<?php
    $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");

    if(isset($_POST['save']))
    {
        $prime = $_POST['prime'];
        $query = "UPDATE bgy_info SET color_theme = '$prime' WHERE id = 1";
        $result = $conn -> query($query);
        
        header("location:configuration.php");
    }
?>