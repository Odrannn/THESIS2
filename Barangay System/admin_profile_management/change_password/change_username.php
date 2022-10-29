<?php

	session_start();
	$userID = $_SESSION['user_id'];
	
    if (isset($_POST['save'])) {
        include("../../phpfiles/connection.php");

		$newusername=$_POST['newusername'];
		$oldpass=$_POST['opwd'];
		
		$exquery = "SELECT * FROM tbluser WHERE username = '$newusername';";
		$exresult = $conn -> query($exquery); 
		$sql=mysqli_query($conn,"SELECT username FROM tbluser where id = '" . $_SESSION['user_id'] . "'");
		
		$query = "SELECT * FROM tbluser where id = '" . $_SESSION['user_id'] . "'";
		$result = $conn -> query($query);
		$row = $result->fetch_array();	
		
		
		if($row['username']==$newusername)
		{
			$_SESSION['msg3']="OLD USERNAME AND NEW USERNAME IS A MATCH";
			header("location:password_page.php");
		}
		else if (mysqli_num_rows($exresult)>0)
		{
			$_SESSION['msg3']="USERNAME ALREADY EXIST";
			header("location:password_page.php");
		}
		else if($row['password']!=$oldpass)
		{
			$_SESSION['msg3']="INCORRECT PASSWORD";
			header("location:password_page.php");
	    }
		else
		{
			$con=mysqli_query($conn,"update tbluser set username='$newusername' where id = '".$_SESSION['user_id']."'");
			$_SESSION['msg4']="USERNAME SUCCESSFULLY CHANGED";
			header("location:password_page.php");
		}
}

?>