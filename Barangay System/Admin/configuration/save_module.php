<?php
    session_start();
    include("../../phpfiles/connection.php");
    if(isset($_POST['save_module']))
    {
        $modules = $_POST['modules'];
        //echo $modules;
            //echo $item . "<br>";

        if(in_array("Case Management", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 1";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 1";
            $result = $conn -> query($query);
        }
        
        if(in_array("Resident Management", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 2";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 2";
            $result = $conn -> query($query);
        }
        
        if(in_array("Healthcare Center", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 3";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 3";
            $result = $conn -> query($query);
        }
        
        if(in_array("Request Verification", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 4";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 4";
            $result = $conn -> query($query);
        }
        
        if(in_array("Official Management", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 5";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 5";
            $result = $conn -> query($query);
        }
        
        if(in_array("User Management", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 6";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 6";
            $result = $conn -> query($query);
        }

        if(in_array("Reports", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 7";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 7";
            $result = $conn -> query($query);
        }
		if(in_array("Logs", $modules)){
            $query = "UPDATE modules_available SET availability = 'yes' WHERE id = 8";
            $result = $conn -> query($query);
        } else {
            $query = "UPDATE modules_available SET availability = 'no' WHERE id = 8";
            $result = $conn -> query($query);
        }

        $_SESSION['message'] = "Modules availability successfully updated.";
        $_SESSION['status'] = "1";

        header("location:configuration.php");
    }
?>