<?php 
session_start();
include("../phpfiles/connection.php");
?>
<head>
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


<body background="images/<?php
        include("../phpfiles/bgy_info.php");
        echo $row[7];
        ?>" class="background">
	<div class="main_container d-flex">
        <div class="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			
				<div class="container-fluid">
					<div style="vertical-align: middle;">
						<img src="../Admin/configuration/uploads/<?php
									include("../phpfiles/bgy_info.php");
									echo $row[2]; ?>" width = "50" height ="50" class="img-thumbnail">
						<h3 class ="m-2" style="float:right; vertical-align: middle;">  BARANGAY <?php echo $row[3]; ?></h3>
					</div>
					<button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" 
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
						aria-expanded="false" aria-label="Toggle navigation">
						<i class="fa-solid fa-bars"></i>
					</button>
					
					<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
						
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item dropdown">
								
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="login.php"><i class="fa-solid fa-user px-2"></i>Login</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<br>
			<div class="container-fluid">
				<div class="card bg-dark text-black">
				  <img src="images/vm.jpg" class="card-img" alt="..." >
				  <div class="card-img-overlay">
					<h5 class="card-title text-center">MISSION</h5>
					<p class="card-text text-center">"<?php echo $row[4];?>"</p>
					<h5 class="card-title text-center">VISION</h5>
					<p class="card-text text-center">"<?php echo $row[5];?>"</p>
				  </div>
				</div>
			</div>
        </div>
    </div>

<div class="container-fluid pt-5">
    <footer style="background-color: #deded5;">
    <div class="container p-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="mb-3" style="letter-spacing: 2px; color: #818963;">CONTACT US</h5>
          <ul class="list-unstyled mb-0">
            <li class="mb-1">
              <h5 style="color: #4f4f4f;">PHONE NUMBER: <?php echo strtoupper($row[8]);?></h5>
            </li>
            <li class="mb-1">
              <h5 style="color: #4f4f4f;">EMAIL: <?php echo strtoupper($row[9]);?></h5>
            </li>
          </ul>
        </div>
		<div class="col-lg-3 col-md-6 mb-4">
		</div>
		<div class="col-lg-3 col-md-6 mb-4">
		</div>
        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="mb-1" style="letter-spacing: 2px; color: #818963;">HEALTHCARE SCHEDULE</h5>
          <table class="table" style="color: #4f4f4f; border-color: #666;">
            <tbody>
              <tr>
                <td>Mon - Sun:</td>
				<?php include("../phpfiles/healthcare_info.php"); ?>
                <td><?php echo $row1[1];?> - <?php echo $row1[2];?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      <H1 class="text-dark">CITY OF <?php echo strtoupper($row[6]);?></H1>
    </div>
  </footer>
</div>
</body>
</html>