<?php
    include("../../phpfiles/connection.php");
    if(isset($_POST['save']))
    {
        $prime = $_POST['prime'];
        $query = "UPDATE bgy_info SET color_theme = '$prime' WHERE id = 1";
        $result = $conn -> query($query);
        
        header("location:configuration.php");
    }
?>