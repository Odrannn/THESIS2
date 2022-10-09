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
    <title>Household Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <?php include("../../../phpfiles/official_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../resident_management.php">Resident</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../household_management/household_management.php">Household</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../residency_application/residency_application.php">Registration</a>
                    </li>
                </ul>
                <br>
                <h2 class="fs-5">Household Management</h2>
                <p>Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length:
                    a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality,
                    though, the unity and coherence of ideas among sentences is what constitutes a paragraph.</p>

                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $_GET['page'] = 1;
                        $page = $_GET['page'];
                    }

                    $start = ($page-1) * 10;
                    $query = "SELECT H.*, R.fname, R.mname, R.lname, R.suffix FROM tblhousehold H INNER JOIN resident_table R ON H.household_head_ID = R.id LIMIT $start, 10;";
                    $result = $conn -> query($query);

                    $result1 = $conn -> query("SELECT count(household_id) as id FROM tblhousehold;");
                    $hhCount = $result1->fetch_assoc();
                    $total = $hhCount['id'];
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
                    <h5 class="card-header">Household List<button class="addhousehold btn btn-success" style="float: right"><i class="fa-solid fa-plus"></i></button></h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Household ID</th>
                                            <th>Family Name</th>
                                            <th>Family Head</th>
                                            <th>Number of Members</th>
                                            <th>Status</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["household_id"]; ?></td>
                                        <td><?php echo $row["household_name"]; ?></td>
                                        <td><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"]; ?></td>
                                        <td><?php echo $row["household_member"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><button data-id="<?php echo $row['household_id']; ?>" class="edithousehold btn btn-danger" <?php
                                            if($row["status"] == "inactive"){
                                                echo "disabled";
                                            } 
                                        ?>><i class="fa-solid fa-box-archive"></i></button></td>
                                    </tr>
                                    
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="household_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="household_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="household_management.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Add Modal-->
    <div class="modal fade modal-md" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        </div>
    </div>
    <!--Edit Modal-->
    <div class="modal fade modal-md" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
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
    
    <script>
        $(document).ready(function(){
            $('.addhousehold').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "add_household_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#addModal').modal('show');
            });
        });
    </script>

<script>
        $(document).ready(function(){
            $('.edithousehold').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "edit_household_form.php",
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