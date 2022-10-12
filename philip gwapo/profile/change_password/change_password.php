 <?php
session_start();
include('../../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../../Login/login.php");
}

if(isset($_POST['Submit']))
{	
	$oldpass=$_POST['opwd'];
	$newpassword=$_POST['npwd'];
	$confirmpassword=$_POST['cpwd'];
	$sql=mysqli_query($conn,"SELECT password FROM tbluser where id = '" . $_SESSION['user_id'] . "'");
	
	$query = "SELECT password FROM tbluser where id = '" . $_SESSION['user_id'] . "'";
	$result = $conn -> query($query);
	$row = $result->fetch_array();	
	if($oldpass!=$row['password'])
	{
		$_SESSION['msg1']="INCORRECT OLD PASSWORD";
		header("location:password_page.php");
	}
	else if($oldpass==$newpassword)
	{
		$_SESSION['msg1']="OLD PASSWORD AND NEW PASSWORD IS MATCH";
		header("location:password_page.php");
	}
	else
	{
		$con=mysqli_query($conn,"update tbluser set password=' $newpassword' where id = '" . $_SESSION['user_id'] . "'");
		$_SESSION['msg2']="PASSWORD SUCCESSFULLY CHANGED";
		header("location:password_page.php");
	}
}

?>