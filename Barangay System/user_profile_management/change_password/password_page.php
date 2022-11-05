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
            <li class=""><a href="../../Residents/file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../../Residents/file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../../Residents/file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../../Residents/request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
			<li class=""><a href="../../Residents/announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/official_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <a href="../../Residents/dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link"  href="../profile.php" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="password_page.php">Account</a>
                    </li>
                </ul>
            </div>
			<div class="tab-content" id="nav-tabContent">
				<div class="container-sm">
				<h1 align="center">ACCOUNT SETTING</h1><hr style="width:100%;text-align:left;margin-left:0">
							<?php
							$query = "SELECT username from tbluser WHERE id = '" . $_SESSION['user_id'] . "'";
							$result = $conn -> query($query);
							$row = $result->fetch_array();
							
							?>
						<div class="text-center">
							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Username</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								  </div>
								  <form name="chnguser" method="post" action="change_username.php" align="center" onSubmit="return valid();">
								  <div class="modal-body">
										<?php
											if (isset($_SESSION['msg1'])){
										?>
										<h5 class="text-danger" align="center" class="text-center"></p><?php echo $_SESSION['msg1'];?><?php echo $_SESSION['msg1']="";?></h5>
										<?php
											} if (isset($_SESSION['msg2'])){
												
										?>
										<h5 class="text-success" align="center" class="text-center"></p><?php echo $_SESSION['msg2'];?><?php echo $_SESSION['msg2']="";?></h5>
										<?php } ?>
										<form name="chnguser" method="post" action="change_username.php" align="center" >
										  <div class="text-start" class="mb-3">
											<label for="exampleInputEmail1" class="form-label">New Username: </label>
											<input name="newusername" type="text" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['username'];?>">
										  </div>
										  <div class="text-start" class="mb-3">
											<label for="exampleInputEmail1" class="form-label">Password: </label>
											<input name="opwd"type="password" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" name="save" class="btn btn-primary">Save changes</button>
										  </div>
									    </form>
								  </div>
								</div>
							  </div>
							</div>	
						</div>	
						<?php
							if (isset($_SESSION['msg3'])){
							
						?>
						<h5 class="text-danger" align="center" class="text-center"></p><?php echo $_SESSION['msg3'];?><?php echo $_SESSION['msg3']="";?></h5>
						<?php
							} if (isset($_SESSION['msg4'])){
								
						?>
						<h5 class="text-success" align="center" class="text-center"></p><?php echo $_SESSION['msg4'];?><?php echo $_SESSION['msg4']="";?></h5>
						<?php } ?>
						
						<div class="container">
						  <div class="row">
							<div class="col"></div>
							<div class="col-6 mb-3">
								<label for="exampleInputEmail1" class="form-label">Current Username</label><br>
								<div class="input-group mb-3">
								  <input type="text" class="form-control" value="<?php echo $row['username'];?>" aria-describedby="button-addon2" disabled>
								  <button class="editresident btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-secondary" type="button" id="button-addon2">Edit Username</button>
								</div>
							</div>
							<div class="col"></div>
						  </div>
						  
						  <form name="chngpwd" method="post" action="change_password.php" onSubmit="return valid();">
							  <div class="row">
								<div class="col"></div>
								<div class="col-6 mb-3">
									<label for="exampleInputEmail1" class="form-label">Current Password</label>
									<input type="password" name="opwd"required id="currentPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<div class="col"></div>
							  </div>
							  
							  <div class="row">
								<div class="col"></div>
								<div class="col-6 mb-3">
									<label for="exampleInputEmail1" class="form-label">New Password</label>
									<input type="password" name="npwd" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<div class="col"></div>
							  </div>
							  
							  <div class="row">
								<div class="col"></div>
								<div class="col-6 mb-3">
									<label for="exampleInputEmail1" class="form-label">Confirm Password</label>
									<input type="password" name="cpwd" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								</div>
								<div class="col"></div>
							  </div>
							  <div class="text-center">
								<button type="submit" name="Submit"  class="btn btn-primary">SAVE PASSWORD</button>
							  </div>
						  </form>
						  
						</div>
						
		
				</div>
			</div>
		</div>
	</div>
		
</body>





</html>