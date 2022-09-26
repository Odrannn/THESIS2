<?php 
session_start();
include('../../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../../Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
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
        include("../../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">Barangay <?php
                                                                                                                                    include("../../../phpfiles/bgy_info.php");
                                                                                                                                    echo $row[3];
                                                                                                                                    ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class=""><a href="../../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-file-lines"></i>&nbsp;File Received</span>
                <span class="bg-dark rounded-pill text-white py-0 px-2">02</span></a></li>
            <li class=""><a href="../../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
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
                                <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="../../../Login/logout.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a href="../case_management.php"class="btn btn-outline-dark">Complaints</an>
                        <a href="../suggestion_management/suggestion_management.php" class="btn btn-outline-dark">Suggestion</a>
                        <a class="btn btn-outline-dark active">Blotter</a>
                    </div>
                </div>
                <br>
                <h2 class="fs-5">Blotter Management</h2>
                <p>Every blotter that is issued in the barangay is compiled by the blotter module, which also contains a function that allows barangay
                    authorities to see how many blotters have been submitted in total, how many cases are still pending, and how many issues have been resolved.
                    It's essential to have a copy of the closed blotter file so they may save it as documentation.</p>
                
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="card mb-3 me-2 bg-success" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-hand-peace"></i>&nbsp;<h5 class="d-inline">Settled: 21</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-danger" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-thumbs-down"></i>&nbsp;<h5 class="d-inline">Unsettled: 21</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-primary" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-calendar-days"></i>&nbsp;<h5 class="d-inline">Scheduled: 21</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-warning" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-calendar-circle-exclamation"></i>&nbsp;<h5 class="d-inline">Unscheduled: 21</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <h5 class="card-header">Suggestion Records</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Blotter ID</th>
                                            <th>Official in Charge</th>
                                            <th>Complainant ID</th>
                                            <th>Complainee ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Accusation</th>
                                            <th>Details</th>
                                            <th>Settlement Schedule</th>
                                            <th>Result of Settlement</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["official_id"]; ?></td>
                                        <td><?php echo $row["resident_id"]; ?></td>
                                        <td><?php echo $row["user_id"]; ?></td>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["position"]; ?></td>
                                        <td><?php echo $row["term_start"]; ?></td>
                                        <td><?php echo $row["term_end"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['official_id']; ?>" class="editofficial btn btn-primary"><i class="fa-solid fa-calendar-days"></i></button>
                                            <button data-id="<?php echo $row['official_id']; ?>" class="editofficial btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--Add Modal-->
    <div class="modal fade modal-lg" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            
        </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- Add resident script-->
    <script>
        $(document).ready(function(){
            $('.addresident').click(function(){
                $.ajax({url: "add_form.php",
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#addModal').modal('show');
            });
        });
    </script>
    <!-- Edit resident script-->
    <script>
        $(document).ready(function(){
            $('.editofficial').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "edit_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
</body>
</html>