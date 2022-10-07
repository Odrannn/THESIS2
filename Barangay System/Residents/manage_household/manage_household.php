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
    <title>Manage Household</title>
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
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
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
                                <a href="../../Login/logout.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                
                <h2 class="text fs-5">Manage Household</h2>
                <p>In this module, you can manage your household information.</p>

                <div class="card">
                    <h5 class="card-header">Household Member List<button class="addmember btn btn-success" style="float: right"><i class="fa-solid fa-plus"></i></button></h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Resident ID</th>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $userid = $_SESSION['user_id'];
                                    //get resident id
                                    $query = "SELECT household_ID FROM resident_table WHERE user_id = '$userid'";
                                    $result = $conn -> query($query);
                                    $row = $result->fetch_array();
                                    $householdID = $row['household_ID'];

                                    //select all members
                                    $query = "SELECT * FROM resident_table WHERE household_ID = '$householdID'";
                                    $result = $conn -> query($query);
                                    $row1 = $result->fetch_array();
                                    //
                                    while($row1 = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row1["id"]; ?></td>
                                        <td><?php echo $row1["fname"] . ' ' . $row1["mname"] . ' ' . $row1["lname"] . ' ' . $row1["suffix"]; ?></td>
                                        <td><?php echo $row1["gender"]; ?></td>
                                        <td><?php echo $row1["age"]; ?></td>
                                        <td><button data-id="<?php echo $row1['id']; ?>" class="edithousehold btn btn-danger"><i class="fa-solid fa-box-archive"></i></button></td>
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
    <div class="modal fade modal-md" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- Add member script-->
    <script>
        $(document).ready(function(){
            $('.addmember').click(function(){
                $.ajax({url: "add_member_form.php",
                    
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