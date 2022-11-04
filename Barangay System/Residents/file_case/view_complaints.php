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
    <title>File Complaint</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            <li class=""><a href="../announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <div>
                    <div class="d-flex justify-content-center">
                        <div class="btn-group">
                            <a class="btn btn-outline-dark active">Complaints</an>
                            <a href="send_suggestion/send_suggestion.php" class="btn btn-outline-dark">Suggestion</a>
                            <a href="file_blotter/file_blotter.php" class="btn btn-outline-dark">Blotter</a>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="text fs-5">File Complaint</h2>
                <p>In this module, locals can complain to the barangay and voice their concerns. Users might also choose to submit a specific issue under the jurisdiction of their barangay.</p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="file_complaint.php">Create Complaint</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">View Complaints</a>
                    </li>
                </ul>
                <br>
                <div class="card">
                    <h5 class="card-header">Complaint List</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Complaint ID</th>
                                            <th>Complaint Nature</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th style ="text-align:center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $userid = $_SESSION['user_id'];
                                    //get resident id
                                    $query = "SELECT id FROM resident_table WHERE user_id = '$userid'";
                                    $result = $conn -> query($query);
                                    $row = $result->fetch_array();
                                    $residentID = $row['id'];

                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    } else {
                                        $_GET['page'] = 1;
                                        $page = $_GET['page'];
                                    }
                                    
                                    $start = ($page-1) * 10;
                                    //select allcomplaints
                                    $query = "SELECT * FROM complaint_table WHERE sender_ID = '$residentID'  LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table WHERE sender_ID = '$residentID'");
                                    $reqCount = $result1->fetch_assoc();
                                    $total = $reqCount['id'];
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
                                    while($row1 = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row1["complaint_ID"]; ?></td>
                                        <td><?php echo $row1["complaint_nature"]; ?></td>
                                        <td><?php echo $row1["comp_desc"]; ?></td>
                                        <td><?php echo $row1["complaint_date"]; ?></td>
                                        <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row1["complaint_status"]=='solved'){echo 'success';}
                                        else if($row1["complaint_status"]=='pending'){
                                            echo 'primary';
                                        }
                                        ?>"><?php echo $row1["complaint_status"]; ?></td>
                                        <td><button data-id="<?php echo $row1["complaint_ID"]?>" class="viewcomp btn btn-primary"><i class="fa-solid fa-eye"></i></button>   
                                        </td>
                                    </tr>
                                    
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
    <!-- View Modal-->
    <div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

    <script>
        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });
        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });
    </script>
    <!-- View resident script-->
    <script>
        $(document).ready(function(){
            $('.viewcomp').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "view_complaint_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewModal').modal('show');
            });
        });
    </script>
</body>
</html>