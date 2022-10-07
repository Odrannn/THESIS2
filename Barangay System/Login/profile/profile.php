<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Boxicons CDN Link -->
</head>

<body>
    <div class="main_container d-flex">
        <div class="sidebar" id="side_nav" style="background: <?php
        include("../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">E-Barangay</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            </ul>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">BS</span></a>
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-bell px-2"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../../Login/profile/profile.php"><i class="fa-solid fa-user px-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../../Login/login.php"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

	<nav>
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
		<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Password</button>
	  </div>
	</nav>
	
	
	
	
	<div class="tab-content" id="nav-tabContent">
	  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<!-- Button trigger modal -->
				<div class="text-center">
					<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="circle.jpg" class="rounded-circle" ></a>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
					  
						<div>
						  <label for="formFileLg" class="form-label">Large file input example</label>
						  <input class="form-control form-control-lg" id="formFileLg" type="file">
						</div>
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					  </div>
					</div>
				  </div>
				</div>
			<table class="table table-borderless">
			  <tbody>
				<?php
                    $connection = new mysqli("localhost", "root", "", "bgy_system");
					$query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                    $result = $connection -> query($query);
                ?>

				<?php while($row = $result->fetch_assoc()){ ?>
				<tr>
				  <th> 
					  <div class="sm-3">
						<label for="exampleInputEmail1" class="form-label">First Name</label>
						<input type="email" class="form-control" value="<?php echo $row["fname"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Last Name</label>
						<input type="email" class="form-control" value="<?php echo $row["lname"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Email</label>
						<input type="email" class="form-control" value="<?php echo $row["email"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Middle Name</label>
						<input type="email" class="form-control" value="<?php echo $row["mname"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Birthday</label>
						<input type="email" class="form-control" value="<?php echo $row["birthday"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Phone Number</label>
						<input type="email" class="form-control" value="<?php echo $row["contactnumber"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Nationality</label>
						<input type="email" class="form-control" value="<?php echo $row["nationality"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Gender</label>
						<input type="email" class="form-control" value="<?php echo $row["gender"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Birthplace</label>
						<input type="email" class="form-control" value="<?php echo $row["birthplace"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Civil Status</label>
						<input type="email" class="form-control" value="<?php echo $row["civilstatus"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Age</label>
						<input type="email" class="form-control" value="<?php echo $row["age"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Unit Number</label>
						<input type="email" class="form-control" value="<?php echo $row["unitnumber"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Purok</label>
						<input type="email" class="form-control" value="<?php echo $row["purok"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Sitio</label>
						<input type="email" class="form-control" value="<?php echo $row["sitio"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Street</label>
						<input type="email" class="form-control" value="<?php echo $row["street"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Subdivision</label>
						<input type="email" class="form-control" value="<?php echo $row["subdivision"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Religion</label>
						<input type="email" class="form-control" value="<?php echo $row["religion"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Occupation</label>
						<input type="email" class="form-control" value="<?php echo $row["occupation"]; ?>" disabled>
					  </div>
				  </th>
				<tr>
				  <th> 
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Disability</label>
						<input type="email" class="form-control" value="<?php echo $row["disability"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	  </div>
	  
	  
	  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">			
		<div class="container-sm">
		<h3 align="center">CHANGE PASSWORD</h3>
			<div><?php if(isset($message)) { echo $message; } ?></div>
			<form method="post" action="change_password.php" align="center">
			Current Password:<br>
			<input type="password" name="old"><span id="currentPassword" class="required"></span>
			<br>
			New Password:<br>
			<input type="password" name="new"><span id="newPassword" class="required"></span>
			<br>
			Confirm Password:<br>
			<input type="password" name="retype"><span id="confirmPassword" class="required"></span>
			<br><br>
			<input name="update" type="submit">
			</form>
	  </div>
	  
	  
	  
</body>
</html>
