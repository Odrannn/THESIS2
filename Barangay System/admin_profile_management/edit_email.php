<?php

	session_start();
	$userID = $_SESSION['user_id'];
	
    if (isset($_POST['saveemail'])) {
        include("../phpfiles/connection.php");

		$email=$_POST['email'];

		$query = "UPDATE resident_table SET email = '$email' where id = '".$_SESSION['user_id']."'";
        $result = $conn -> query($query);
        header("location:profile.php");
		
}

?>