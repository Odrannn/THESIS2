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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
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
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
            <li class=""><a href="../resident_management/resident_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-people-group"></i>&nbsp;Resident</a></li>
            <li class=""><a href="../document_request/document_request.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-invoice"></i>&nbsp;Request</a></li>
            <li class=""><a href="../official_management/official_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-image-portrait"></i>&nbsp;Official</a></li>
            <li class=""><a href="../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
            <li class="active"><a href="../reports/report.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-newspaper"></i>&nbsp;Reports</a></li>
            <hr class="text-light">
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>
        <div class="content">
            <?php include("../../phpfiles/official_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <h2 class="fs-5">Reports</h2>
                <p>The barangay administrator or the barangay captain can simply change simple generate barangay report whether it is case management or population report.</p>
			</div>
			<hr>
			 <div class="card mt-2 mx-3">
				<h5 class="card-header">RANGE REPORT</h5>
                <div class="card-body">
					<div class="container">
					<form class="form-inline" method="POST" action="generate_report.php">
					  <div class="row">
						<div class="col">
								<div class="form-floating">
								<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" required />
								<label for="status">FROM</label>
								</div>
						</div>
						<div class="col">
								<div class="form-floating">
								<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" required />
								<label for="status">TO</label>
								</div>
						</div>
						<div class="col">
								<div class="form-floating"> 
									<select class="form-control" id="status" name="type" required>
										<option name="type" value="Complaint">Complaint</option>
										<option name="type" value="Suggest">Suggest</option>
										<option name="type" value="Blotter">Blotter</option>
									</select>
										<label for="status">TYPE</label>
								</div>
						</div>
						<div class="col">
						<button type="submit" class="btn btn-primary" name="generate">GENERATE</button>
						</div>
					</form>
					  </div>
					</div>
				<br>
				<h5 class="card-header">POPULATION REPORT</h5>
                <div class="card-body">
					<div class="container">
					  <div class="row">
						<div class="col">
						  BARANGAY RESIDENT<a href="../../generate_document/resident.php" class="btn btn-primary">GENERATE </A>
						</div>
					  </div>
					</div>
				</div>
				<BR>
                <h5 class="card-header">COMPLAINT REPORT</h5>
                <div class="card-body">
					<div class="container">
					  <div class="row">
						<div class="col">
						  DAILY <a href="../../generate_document/complaint_daily.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  WEEKLY <a href="../../generate_document/complaint_weekly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  MONTHLY <a href="../../generate_document/complaint_monthly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  YEARLY <a href="../../generate_document/complaint_yearly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  ALL <a href="../../generate_document/complaint_all.php" class="btn btn-primary">GENERATE </A>
						</div>
					  </div>
					</div>
				</div>
				<BR>
				<h5 class="card-header">BLOTTER</h5>
                <div class="card-body">
					<div class="container">
					  <div class="row">
						<div class="col">
						  DAILY <a href="../../generate_document/blotter_daily.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  WEEKLY <a href="../../generate_document/blotter_weekly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  MONTHLY <a href="../../generate_document/blotter_monthly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  YEARLY <a href="../../generate_document/blotter_yearly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  ALL <a href="../../generate_document/blotter_all.php" class="btn btn-primary">GENERATE </A>
						</div>
					  </div>
					</div>
				</div>
				<br>
				<h5 class="card-header">SUGGESTION</h5>
                <div class="card-body">
					<div class="container">
					  <div class="row">
						<div class="col">
						  DAILY <a href="../../generate_document/suggest_daily.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  WEEKLY <a href="../../generate_document/suggest_weekly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  MONTHLY <a href="../../generate_document/suggest_monthly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col">
						  YEARLY <a href="../../generate_document/suggest_yearly.php" class="btn btn-primary">GENERATE </A>
						</div>
						<div class="col"> 
						  ALL <a href="../../generate_document/suggest_all.php" class="btn btn-primary">GENERATE </A>
						</div>
					  </div>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>

		
		
	</div>
</body>
</html>