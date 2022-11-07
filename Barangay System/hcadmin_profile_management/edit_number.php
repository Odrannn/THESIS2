<?php

	session_start();
	$userID = $_SESSION['user_id'];
	
    if (isset($_POST['savenum'])) {
        include("../phpfiles/connection.php");

		$contactnumber=$_POST['contactnumber'];

		$query = "UPDATE resident_table SET contactnumber = '$contactnumber' where id = '".$_SESSION['user_id']."'";
        $result = $conn -> query($query);
        header("location:profile.php");
		
}

?>