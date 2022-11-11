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
                <h2 class="fs-5">Logs</h2>
                <p>The barangay administrator or the barangay captain can simply determine who's logging in and logging out in the barangay system.</p>
			</div>
			<hr>
			
				<?php
							if(isset($_GET['page'])){
								$page = $_GET['page'];
							} else {
								$_GET['page'] = 1;
								$page = $_GET['page'];
							}
							
							$start = ($page-1) * 10;
							$query = "SELECT * FROM logs LIMIT $start, 10;";
							$result = $conn -> query($query);

							$result1 = $conn -> query("SELECT count(log_id) as id FROM logs;");
							$resCount = $result1->fetch_assoc();
							$total = $resCount['id'];
							$pages = ceil($total / 10);
							
							if($page > 1){
								$previous = $page - 1;
							} else {
								$previous = $page;
							}

							if($page < $pages){
								$next = $page + 1;
							} else {
								$next = $page;
							}
				?>
				
				<div class="card">
                    <h5 class="card-header">Log List</h5>
                    <!--<a class="text-decoration-none mx-4 pt-2" href="residency_application/residency_application.php">
                        <i class="fa-solid fa-user-plus"></i>&nbsp;<span>Residency Registration</span>
                    </a>-->
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md pt-2">
                                    <input type="text" class="form-control" id="search" placeholder="Enter name...">
                                </div>
                                <div class="col-md pt-2">
                                </div>
                                <div class="col-md pt-2">
                                </div>
                                <div class="col-md pt-2">
                                </div>
                                <div class="col-md pt-2">
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>LOG ID</th>
                                            <th>User ID</th>
                                            <th>DATE & TIME</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "output">
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["log_id"]; ?></td>
                                        <td><?php echo $row["user_id"]; ?></td>
                                        <td><?php echo $row["date_time"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="userinfo btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                            <button class="editresident btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <!--Add Modal-->
                                <div class="modal fade modal-xl" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <div><a class="import btn btn-outline-success">Import</a></div>
                        <div id="response">Please wait..</div>
                    </div>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="logs.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="logs.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="logs.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>



</body>
</html>