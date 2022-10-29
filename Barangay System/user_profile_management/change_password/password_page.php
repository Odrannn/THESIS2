<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="main_container d-flex">
        <div class="sidebar" id="side_nav" style="background: <?php
        include("../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">Barangay <?php
                                                                                                                            include("../../phpfiles/bgy_info.php");
                                                                                                                            echo $row[3];
                                                                                                                            ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../Residents/file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../Residents/file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../Residents/file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../Residents/request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <a href="../Residents/dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link"  href="../profile.php" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="password_page.php">Password</a>
                    </li>
                </ul>
            </div>
			<div class="tab-content" id="nav-tabContent">
				<div class="container-sm">
				<h1 align="center">CHANGE PASSWORD</h1>
						<?php
							if (isset($_SESSION['msg1'])){
							
						?>
						<h5 class="text-danger" align="center" class="text-center"></p><?php echo $_SESSION['msg1'];?><?php echo $_SESSION['msg1']="";?></h5>
						<?php
							} if (isset($_SESSION['msg2'])){
								
						?>
						<h5 class="text-success" align="center" class="text-center"></p><?php echo $_SESSION['msg2'];?><?php echo $_SESSION['msg2']="";?></h5>
						<?php } ?>
						<form name="chngpwd" method="post" action="change_password.php" align="center" onSubmit="return valid();">
							Current Password:<br>
							<input type="password" name="opwd"><span id="currentPassword" class="required"></span>
							<br>
							New Password:<br>
							<input type="password" name="npwd"><span id="newPassword" class="required"></span>
							<br>
							Confirm Password:<br>
							<input type="password" name="cpwd"><span id="confirmPassword" class="required"></span>
							<br><br>
							<input type="submit" name="Submit" value="Change Passowrd">
						</form>
				</div>
			</div>
		</div>
	</div>
		
</body>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Filed is Empty !!");
document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>

</html>