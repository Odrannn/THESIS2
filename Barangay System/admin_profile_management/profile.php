<?php 
session_start();
include('../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resident Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="main_container d-flex">
        <div class="sidebar" id="side_nav" style="background: <?php
        include("../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">Barangay <?php
                                                                                                                                    include("../phpfiles/bgy_info.php");
                                                                                                                                    echo $row[3];
                                                                                                                                    ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class=""><a href="../Admin/dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../Admin/announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../Admin/configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
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
					<?php
						$query2 = "SELECT * FROM admin_notification ORDER BY notification_ID DESC;";
						$result2 = $conn -> query($query2);

						$queryc = "SELECT * FROM admin_notification WHERE status = '0'";
						$resultc = $conn -> query($queryc);
						$count = mysqli_num_rows($resultc);
					?>
					<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item dropdown">
								<a class="nav-link" aria-current="page" href="#" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-bell px-2"></i><?php if($count != 0){?>
									<span class="bg-danger rounded-pill text-white badge" style = "position:relative;top:-10px;left:-20px;"><?php echo $count?></span>
									<?php }?>
								</a>
								<!--Notification List-->
								<ul class="dropdown-menu dropdown-menu-end" style="height: auto; max-height: 600px; overflow-x: hidden;">
									<?php while($rownot = $result2->fetch_assoc()){
										$timestamp = $rownot['date_time'];
										$dateTime = date("M d, Y, g:i a",strtotime($timestamp));

										$query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
										$result1 = $conn -> query($query1);
										$row1 = $result1->fetch_assoc();
										$name = $row1['fname'] . " " . $row1['lname'];
										if($rownot['status'] == '0'){ 
											$notifID = $rownot['notification_ID'];?>

											<li><a class="dropdown-item " href="../../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
											<b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
											<?php echo $name . " " . $rownot['message']; ?><br>
											<b class="text-primary"><?php echo $dateTime;?></b>
											</a></li>
											<li><hr class="dropdown-divider"></li>
									<?php 
										} else {
											$notifID = $rownot['notification_ID'];?>
											<li ><a class="dropdown-item" href="../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
											<?php echo $rownot['notification_type'];?><br>
											<?php echo $name . " " . $rownot['message']; ?><br>
											<?php echo $dateTime;?>

											</a></li>
											<li><hr class="dropdown-divider"></li>
										<?php   
										}
									}?>
								</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
							</li>
							<li class="nav-item">
								<a href="../../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
            <div class="dashboard-content px-3 py-4">
                <a href="../Admin/dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active"  href="profile.php" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="change_password/password_page.php">Password</a>
                    </li>
                </ul>
            </div>
			<div class="tab-content" id="nav-tabContent">
	  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<!-- Button trigger modal -->
				<div class="text-center">
					<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
					<img  src="../Admin/resident_management/residentimages/<?php 
					$query = "SELECT profile from tbluser WHERE id = '" . $_SESSION['user_id'] . "'";
					$result = $conn -> query($query);
					$row = $result->fetch_array();
					echo $row['profile'];?>" class="rounded-circle" id="profileimg" ></a>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
					  <label for="formFileLg" class="form-label">Current Profile</label>
					  <img src="../Admin/resident_management/residentimages/<?php echo $row['profile'];?>"class="rounded mx-auto d-block" id="profileimg">
					  <form class="g-3" action="profile_upload.php" method="post" enctype="multipart/form-data" onSubmit= "window.close();">
						<div>
						  <label for="formFileLg" class="form-label"></label>
						  <input class="form-control form-control-lg" id="formFileLg" type="file" name="ann_image">
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
			<table class="table table-borderless" id="profiletable">
			  <tbody>
				<?php
					$query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                    $result = $conn -> query($query);
                ?>

				<?php while($row = $result->fetch_assoc()){ ?>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">First Name</label>
						<input type="email" class="form-control" value="<?php echo $row["fname"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Last Name</label>
						<input type="email" class="form-control" value="<?php echo $row["lname"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Email</label>
						<input type="email" class="form-control" value="<?php echo $row["email"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Middle Name</label>
						<input type="email" class="form-control" value="<?php echo $row["mname"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Birthday</label>
						<input type="email" class="form-control" value="<?php echo $row["birthday"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Phone Number</label>
						<input type="email" class="form-control" value="<?php echo $row["contactnumber"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Nationality</label>
						<input type="email" class="form-control" value="<?php echo $row["nationality"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Gender</label>
						<input type="email" class="form-control" value="<?php echo $row["gender"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Birthplace</label>
						<input type="email" class="form-control" value="<?php echo $row["birthplace"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Civil Status</label>
						<input type="email" class="form-control" value="<?php echo $row["civilstatus"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Age</label>
						<input type="email" class="form-control" value="<?php echo $row["age"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Unit Number</label>
						<input type="email" class="form-control" value="<?php echo $row["unitnumber"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Purok</label>
						<input type="email" class="form-control" value="<?php echo $row["purok"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Sitio</label>
						<input type="email" class="form-control" value="<?php echo $row["sitio"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Street</label>
						<input type="email" class="form-control" value="<?php echo $row["street"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Subdivision</label>
						<input type="email" class="form-control" value="<?php echo $row["subdivision"]; ?>" disabled>
					  </div>
				  </th>
				</tr>
				<tr>
				  <th> 
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Religion</label>
						<input type="email" class="form-control" value="<?php echo $row["religion"]; ?>" disabled>
					  </div>
				  </th>
				  <th>
					  <div class="mx-3">
						<label for="exampleInputEmail1" class="form-label">Occupation</label>
						<input type="email" class="form-control" value="<?php echo $row["occupation"]; ?>" disabled>
					  </div>
				  </th>
				<tr>
				  <th> 
					  <div class="mx-3">
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
			
		</div>
	</div>
		
</body>
</html>