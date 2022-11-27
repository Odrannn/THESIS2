<?php

	session_start();
	$userID = $_SESSION['user_id'];
	
    if (isset($_POST['savenum'])) {
        include("../phpfiles/connection.php");

		$contactnumber=$_POST['contactnumber'];

        $exquery = "SELECT * FROM resident_table WHERE contactnumber = '$contactnumber';";
        $exresult = $conn -> query($exquery); 
        $sql=mysqli_query($conn,"SELECT contactnumber FROM resident_table where user_id = '" . $_SESSION['user_id'] . "'");
        



        if(mysqli_num_rows($exresult)>0){
            echo "<script>
            window.location.href='profile.php';
            alert('CONTACT NUMBER ALREADRY EXIST');
            </script>";
        }else{
            $query = "UPDATE resident_table SET contactnumber = '$contactnumber' where user_id = '".$_SESSION['user_id']."'";
            $result = $conn -> query($query);
            header("location:profile.php");
        }

		
}

?>