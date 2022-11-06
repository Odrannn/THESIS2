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
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../Residents/file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../Residents/file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../Residents/file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../Residents/request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
			<li class=""><a href="../Residents/announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
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
						//GET RESIDENT ID
						$queryR = "SELECT * FROM resident_table WHERE user_id = '".$_SESSION['user_id']."';";
						$resultR = $conn -> query($queryR);
						$rowR = $resultR->fetch_assoc();
						$residentID = $rowR['id'];

						$query2 = "SELECT * FROM user_notification WHERE resident_ID = '$residentID' ORDER BY notification_ID DESC;";
						$result2 = $conn -> query($query2);
						$count1 = mysqli_num_rows($result2);

						$queryc = "SELECT * FROM user_notification WHERE status = '0' AND resident_ID = '$residentID'";
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
									<?php 
									if($count1 != 0){
										while($rownot = $result2->fetch_assoc()){
											$timestamp = $rownot['date_time'];
											$dateTime = date("M d, Y, g:i a",strtotime($timestamp));

											$query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
											$result1 = $conn -> query($query1);
											$row1 = $result1->fetch_assoc();
											if($rownot['status'] == '0'){ 
												$notifID = $rownot['notification_ID'];?>
												<li><a class="dropdown-item " href="../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
												<b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
												<?php echo $rownot['message']; ?><br>
												<b class="text-primary"><?php echo $dateTime;?></b>
												</a></li>
												<li><hr class="dropdown-divider"></li>
										<?php 
											} else {
												$notifID = $rownot['notification_ID'];?>
												<li ><a class="dropdown-item" href="../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
												<?php echo $rownot['notification_type'];?><br>
												<?php echo $rownot['message']; ?><br>
												<?php echo $dateTime;?>

												</a></li>
												<li><hr class="dropdown-divider"></li>
											<?php   
											}
										}
									} else {?>
										<li ><p class="dropdown-item">No notification right now.</p></li>
									<?php 
									}?>
								</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
							</li>
							<li class="nav-item">
								<a href="../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
            <div class="dashboard-content px-3 py-4">
                <a href="../Residents/dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active"  href="profile.php" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="change_password/password_page.php">Account</a>
                    </li>
                </ul>
            </div>
			
			
						<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<!-- Button trigger modal -->
								<div>
									<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
									<img src="../Admin/resident_management/residentimages/<?php 
									$query = "SELECT profile from tbluser WHERE id = '" . $_SESSION['user_id'] . "'";
									$result = $conn -> query($query);
									$row = $result->fetch_array();
									echo $row['profile'];?>" class="float-start border border-dark border-4 rounded-circle mx-5" id="profileimg" ></a>
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
						</div>
						<div class="container-fluid">
							<div class="row">
						
						
						<?php
							$query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
							$result = $conn -> query($query);
						?>
						<?php while($row = $result->fetch_assoc()){ ?>
					</div>

					</div>
				</div>
			<div class="container-fluid">
			  <div class="row" >
				<div class="ps-5 col-5"><h3>PERSONAL INFORMATION:</h3></div>
				<div class="col-5"></div><BR><BR>
			  <HR>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>FULL NAME :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"];  ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>GENDER :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["gender"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>BIRTHDAY :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["birthday"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>AGE :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php 
						$dateOfBirth = $row["birthday"];
						$today = date("Y-m-d");
						$diff = date_diff(date_create($dateOfBirth), date_create($today));
						echo $diff->format('%y');
						?>" disabled>
					</div>
				</div>
			  </div><BR><BR>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>CIVIL STATUS :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["civilstatus"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>CONTACT NO. :</strong></div>
				<div class="col-5">
					<div class="mx-3" width=100>
						<input type="email" class="form-control" value="<?php echo $row["contactnumber"]; ?>" disabled>
					</div>
				</div>
				
				<div class="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#numberModal">EDIT</button></div>
			  </div><BR><BR>
			  <div class="modal fade" id="numberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Contact Number</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <form name="chnguser" method="post" action="edit_number.php">
						  <div class="modal-body">
							  <label for="exampleInputEmail1" class="form-label">Contact Number: </label>
							  <input name="contactnumber" type="number" class="form-control" value="<?php echo $row["contactnumber"]; ?>" >
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button name="savenum" type="submit" class="btn btn-primary">Save changes</button>
						  </div>
					  </form>
					</div>
				  </div>
			  </div>
			  
			  <div class="row">
				<div class="ps-5 col-4"><strong>EMAIL :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["email"]; ?>" disabled>
					</div>
				</div>
				<div class="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#emailModal">EDIT</button></div>
			  </div><BR><BR>
			  <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Email</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <form name="chnguser" method="post" action="edit_email.php">
					  <div class="modal-body">
						  <label for="exampleInputEmail1" class="form-label">Email: </label>
						  <input name="email" type="email" class="form-control" value="<?php echo $row["email"]; ?>" >
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button  name="saveemail" type="submit" class="btn btn-primary" name="emailsave">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
			  </div>
				
				
				
				
			  <div class="row">
				<div class="ps-5 col-4"><strong>UNIT NUMBER :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["unitnumber"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>		

			  <div class="row">
				<div class="ps-5 col-4"><strong>PUROK :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["purok"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>SITIO :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["sitio"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>STREET :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["street"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>SUBDIVISION :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["subdivision"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>RELIGION :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["religion"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>OCCUPATION :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["occupation"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>NATIONALITY :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["nationality"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			  <div class="row">
				<div class="ps-5 col-4"><strong>DISABILITY :</strong></div>
				<div class="col-5">
					<div class="mx-3">
						<input type="email" class="form-control" value="<?php echo $row["disability"]; ?>" disabled>
					</div>
				</div>
			  </div><BR><BR>

			</div>
		</div>
		<?php } ?>	
		
		</div>
		</div>
	</div>





</body>
</html>