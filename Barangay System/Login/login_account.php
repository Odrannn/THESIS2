<?php 
session_start();
//read from database
include("../phpfiles/connection.php");

if(isset($_POST['admin']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	date_default_timezone_set('Asia/Manila'); // SET TIMEZONE
	$date1 = date('y-m-d h:i:s');
	

	if(!empty($username) && !empty($password))
	{
		$query = "select * from tbluser where username = '$username' limit 1";
		$result = mysqli_query($conn, $query);

		if($result)
		{
			if(mysqli_num_rows($result) > 0)
			{

				$user_data = mysqli_fetch_assoc($result);
				
				if($user_data['password'] == $password)
				{

					$_SESSION['user_id'] = $user_data['id'];
					$user = $_SESSION['user_id'];
					if($user_data['type'] == 'user'){
						$_SESSION['user_id'] = '';
						$_SESSION['message'] = "Error! You can't log in as Admin.";
						header("location:login.php");
					}else if($user_data['type'] == 'hadmin'){
						$query1 = "INSERT INTO logs (user_id,date_time)
						VALUES ('$user','$date1');";
						$result1 = $conn -> query($query1);
						header("location:../Healthcare_Admin/healthcare_center/healthcare_center.php");
					}else{
						$query1 = "INSERT INTO logs (user_id,date_time)
						VALUES ('$user','$date1');";
						$result1 = $conn -> query($query1);
						header("location:../Admin/dashboard/dashboard.php");
					} 
					die;
				}
			}
		}
		$_SESSION['message'] = "Wrong username or password!";
		header("location:login.php");
	} else
	{
		$_SESSION['message'] = "Wrong username or password!";
		header("location:login.php");
	}
}

if(isset($_POST['resident']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(!empty($username) && !empty($password))
	{
		$query = "select * from tbluser where username = '$username' limit 1";
		$result = mysqli_query($conn, $query);

		if($result)
		{
			if(mysqli_num_rows($result) > 0)
			{

				$user_data = mysqli_fetch_assoc($result);
				
				if($user_data['password'] == $password)
				{
					$_SESSION['user_id'] = $user_data['id'];
					$user = $_SESSION['user_id'];
					$query1 = "INSERT INTO logs (user_id,date_time)
					VALUES ('$user','$date1');";
					$result1 = $conn -> query($query1);
					header("location:../Residents/dashboard/dashboard.php");		
					die;
				}
				
			}
		}
		$_SESSION['message'] = "Wrong username or password!";
		header("location:login.php");
	} else
	{
		$_SESSION['message'] = "Wrong username or password!";
		header("location:login.php");
	}
}

?>