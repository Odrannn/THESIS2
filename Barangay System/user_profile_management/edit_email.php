<?php

	session_start();
	$userID = $_SESSION['user_id'];
	
    if (isset($_POST['saveemail'])) {
        include("../phpfiles/connection.php");

        

		$email=$_POST['email'];

        $exquery = "SELECT * FROM resident_table WHERE email = '$email';";
        $exresult = $conn -> query($exquery); 
        $sql=mysqli_query($conn,"SELECT email FROM resident_table where user_id = '" . $_SESSION['user_id'] . "'");
        



        if(mysqli_num_rows($exresult)>0){
            echo "<script>
            window.location.href='profile.php';
            alert('EMAIL ALREADY EXIST');
            </script>";
        }else{
            $query = "UPDATE resident_table SET email = '$email' where user_id = '".$_SESSION['user_id']."'";
            $result = $conn -> query($query);
            header("location:profile.php");
        }
		
}

?>