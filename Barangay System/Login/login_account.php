<?php 
	$_SESSION['message']='';
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password))
		{

			//read from database
            $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
			$query = "select * from tbluser where username = '$username' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['id'];
                        if($user_data['type'] == 'user'){
                            header("location:../Residents/dashboard/dashboard.php");
                        }else if($user_data['type'] == 'admin'){
                            header("location:../Admin/dashboard/dashboard.php");
                        } 
                        die;
					}
				}
			}
			$_SESSION['message'] = "wrong username or password!";
            header("location:login.php");
		} else
		{
			$_SESSION['message'] = "wrong username or password!";
            header("location:login.php");
		}
	}

?>