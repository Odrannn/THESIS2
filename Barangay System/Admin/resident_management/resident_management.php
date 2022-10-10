<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Resident</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="household_management/household_management.php">Household</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="residency_application/residency_application.php">Registration</a>
                    </li>
                </ul>
                <br>
                <h2 class="fs-5">Resident Management</h2>
                <p>Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length:
                    a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality,
                    though, the unity and coherence of ideas among sentences is what constitutes a paragraph.</p>

                <div class="d-flex justify-content-center">
                <?php
                    $tquery = "SELECT count(id) FROM resident_table;";
                    $tresult = $conn -> query($tquery);
                    $trow = $tresult -> fetch_array();
                ?>
                    <div>
                        <div class="card mb-3 me-2 bg-dark" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                <i class="fa-solid fa-people-group"></i>&nbsp;<h5 class="d-inline">Total: <?php echo $trow[0]?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                            $tquery = "SELECT count(household_id) FROM tblhousehold WHERE status ='active';";
                            $tresult = $conn -> query($tquery);
                            $trow = $tresult -> fetch_array();
                        ?>
                        <div class="card mb-3 me-2 bg-dark" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-house"></i>&nbsp;<h5 class="d-inline">Household: <?php echo $trow[0]?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                            $mquery = "SELECT count(id) FROM resident_table WHERE gender = 'male';";
                            $mresult = $conn -> query($mquery);
                            $mrow = $mresult -> fetch_array();
                        ?>
                        <div class="card mb-3 me-2 bg-dark" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-mars"></i>&nbsp;<h5 class="d-inline">Male: <?php
                                    echo $mrow[0]?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                            $fquery = "SELECT count(id) FROM resident_table WHERE gender = 'female';";
                            $fresult = $conn -> query($fquery);
                            $frow = $fresult -> fetch_array();
                        ?>
                        <div class="card mb-3 me-2 bg-dark" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-venus"></i>&nbsp;<h5 class="d-inline">Female: <?php
                                echo $frow[0]?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $_GET['page'] = 1;
                        $page = $_GET['page'];
                    }
                    
                    $start = ($page-1) * 10;
                    $query = "SELECT * FROM resident_table LIMIT $start, 10;";
                    $result = $conn -> query($query);

                    $result1 = $conn -> query("SELECT count(id) as id FROM resident_table;");
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
                    <h5 class="card-header">Resident List<button class="addresident btn btn-success" style="float: right">Add</button></h5>
                    <!--<a class="text-decoration-none mx-4 pt-2" href="residency_application/residency_application.php">
                        <i class="fa-solid fa-user-plus"></i>&nbsp;<span>Residency Registration</span>
                    </a>-->
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="align-top">
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Suffix</th>
                                            <th>Gender</th>
                                            <th>Birthplace</th>
                                            <th>Civil Status</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Unit Number</th>
                                            <th>Purok</th>
                                            <th>Sitio</th>
                                            <th>Street</th>
                                            <th>Subdivision</th>
                                            <th>Contact No.</th>
                                            <th>E-mail</th>
                                            <th>Religion</th>
                                            <th>Occupation</th>
                                            <th>Educational Attainment</th>
                                            <th>Nationality</th>
                                            <th>Disability</th> 
                                            <th>Status</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["user_id"]; ?></td>
                                        <td><?php echo $row["fname"]; ?></td>
                                        <td><?php echo $row["mname"]; ?></td>
                                        <td><?php echo $row["lname"]; ?></td>
                                        <td><?php echo $row["suffix"]; ?></td>
                                        <td><?php echo $row["gender"]; ?></td>
                                        <td><?php echo $row["birthplace"]; ?></td>
                                        <td><?php echo $row["civilstatus"]; ?></td>
                                        <td><?php echo $row["birthday"]; ?></td>
                                        <td><?php echo $row["age"]; ?></td>
                                        <td><?php echo $row["unitnumber"]; ?></td>
                                        <td><?php echo $row["purok"]; ?></td>
                                        <td><?php echo $row["sitio"]; ?></td>
                                        <td><?php echo $row["street"]; ?></td>
                                        <td><?php echo $row["subdivision"]; ?></td>
                                        <td><?php echo $row["contactnumber"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["religion"]; ?></td>
                                        <td><?php echo $row["occupation"]; ?></td>
                                        <td><?php echo $row["education"]; ?></td>
                                        <td><?php echo $row["nationality"]; ?></td>
                                        <td><?php echo $row["disability"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['id']; ?>" class="userinfo btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                            <button data-id="<?php echo $row['id']; ?>" class="editresident btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
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
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="resident_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="resident_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="resident_management.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--View Modal-->
    <div class="modal fade modal-lg" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            
                    
                
        </div>
    </div>
    

    <!--Edit Modal-->
    <div class="modal fade modal-xl" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <script>
        $(document).ready(function(){
            $('.userinfo').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "resident_details.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewModal').modal('show');
            });
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
            $('.editresident').click(function(){
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