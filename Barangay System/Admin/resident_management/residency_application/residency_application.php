<?php 
session_start();
include('../../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../../Login/login.php");
}
?>
<?php
    if (isset($_POST['start'])){
        $start = $conn -> real_escape_string($_POST['start']);

        $allData = '';
        $resultm = $conn -> query("SELECT * FROM registration LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            if($row["religion"]=="Jehovah''s Witnesses" ){
                $row["religion"]="Jehovah'''s Witnesses";
            }
            if($row["educational"]=="Bachelor''s Degree"){
                $row["educational"]="Bachelor'''s Degree";
            }

            $allData .= $row["id"] . ',' . $row["fname"] . ',' . $row["mname"] . ',' . $row["lname"] . ',' . $row["suffix"] . ',' . $row["gender"] . ',' . $row["birthplace"] . ',' . 
            $row["civilstatus"] . ',' . $row["birthday"] . ',' . $row["unitnumber"] . ',' . $row["purok"] . ',' . $row["sitio"] . ',' . $row["street"] . ',' . $row["subdivision"] . ',' . 
            $row["contactnumber"] . ',' . $row["email"] . ',' . $row["religion"] . ',' . $row["occupation"] . ',' . $row["educational"] . ',' . $row["nationality"] . ',' . $row["disability"] . ',' . $row["status"]
            . ',' . $row["img_path"] . ',' . "\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT id FROM registration;");
    $numRows = mysqli_num_rows($sql);
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
</head>

<body>
    <div class="main_container d-flex">
        <div class="sidebar" id="side_nav" style="background: <?php
        include("../../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class=""><img src="../../configuration/uploads/<?php
                include("../../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "50" height ="50" class="img-thumbnail"></span><span class="text-white">  Barangay <?php
                                                                                                                                    include("../../../phpfiles/bgy_info.php");
                                                                                                                                    echo $row[3];
                                                                                                                                    ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class=""><a href="../../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <?php 
            include('../../../phpfiles/modules_available.php');
            if($availability[0] == 'yes'){ ?>
            <li class=""><a href="../../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
            <?php } 
            if($availability[1] == 'yes'){ ?>
            <li class="active"><a href="../../resident_management/resident_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-people-group"></i>&nbsp;Resident</a></li>
            <?php } 
            if($availability[3] == 'yes'){ ?>
            <li class=""><a href="../../document_request/document_request.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-invoice"></i>&nbsp;Request</a></li>
            <?php } 
            if($availability[4] == 'yes'){ ?>
            <li class=""><a href="../../official_management/official_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-image-portrait"></i>&nbsp;Official</a></li>
            <?php } 
            if($availability[5] == 'yes'){ ?>
            <li class=""><a href="../../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
            <?php } 
            if($availability[6] == 'yes'){ ?>
            <li class=""><a href="../../reports/report.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-newspaper"></i>&nbsp;Reports</a></li>
            <?php } ?>
            <hr class="text-light">
            <li class=""><a href="../../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class=""><img src="../../configuration/uploads/<?php
                include("../../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "50" height ="50" class="img-thumbnail"></span></a>
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

                                        if($rownot['notification_type'] != 'Residency Registration'){
                                            $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                                            $result1 = $conn -> query($query1);
                                            $row1 = $result1->fetch_assoc();
                                            $name = $row1['fname'] . " " . $row1['lname'];
                                        }
                                        
                                        if($rownot['status'] == '0'){ 
                                            $notifID = $rownot['notification_ID'];?>

                                            <li><a class="dropdown-item " href="../../../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
                                            <b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
                                            <?php if($rownot['notification_type'] != 'Residency Registration'){ echo $name . " " . $rownot['message']; }
                                            else {echo $rownot['message'];}?><br>
                                            <b class="text-primary"><?php echo $dateTime;?></b>
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                    <?php 
                                        } else {
                                            $notifID = $rownot['notification_ID'];?>
                                            <li ><a class="dropdown-item" href="../../../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
                                            <?php echo $rownot['notification_type'];?><br>
                                            <?php if($rownot['notification_type'] != 'Residency Registration'){ echo $name . " " . $rownot['message']; }
                                            else {echo $rownot['message'];}?><br>
                                            <?php echo $dateTime;?>

                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                        <?php   
                                        }
                                    }?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../../admin_profile_management/profile.php"><i class="fa-solid fa-user px-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="../../../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../resident_management.php">Resident</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../household_management/household_management.php">Household</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Registration</a>
                    </li>
                </ul>
                <br>
                <h2 class="fs-5">Residency Application</h2>
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
                    $query = "SELECT * FROM registration ORDER BY id DESC LIMIT $start, 10";
                    $result = $conn -> query($query);

                    $result1 = $conn -> query("SELECT count(id) as id FROM registration;");
                    $regCount = $result1->fetch_assoc();
                    $total = $regCount['id'];
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
                <!--alert message-->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>
                <?php 
                if (isset($_SESSION["importRegistration"])){
                    if($_SESSION["importRegistration"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importRegistration"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importRegistration"] = "";
                }
                ?>
                <?php 
                if (isset($_SESSION["residencyMessage"])){
                    if($_SESSION["residencyMessage"] == 1){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                Registration Accepted.
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["residencyMessage"] = 0;
                }
                ?>
                <div class="card">
                    <h5 class="card-header">Application List</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md pt-2">
                                    <input type="text" class="form-control" id="search" placeholder="Enter Keyword...">
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
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Suffix</th>
                                            <th>Gender</th>
                                            <th>Birthplace</th>
                                            <th>Civil Status</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Household ID</th>
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
                                            <th style ="text-align:center;">Status</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="output">
                                        <?php while($row = $result->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $row["id"]; ?></td>
                                            <td><?php echo $row["fname"]; ?></td>
                                            <td><?php echo $row["mname"]; ?></td>
                                            <td><?php echo $row["lname"]; ?></td>
                                            <td><?php echo $row["suffix"]; ?></td>
                                            <td><?php echo $row["gender"]; ?></td>
                                            <td><?php echo $row["birthplace"]; ?></td>
                                            <td><?php echo $row["civilstatus"]; ?></td>
                                            <td><?php echo $row["birthday"]; ?></td>
                                            <td><?php 
                                                $dateOfBirth = $row["birthday"];
                                                $today = date("Y-m-d");
                                                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                echo $diff->format('%y');
                                            ?></td>
                                            <td><?php echo $row["unitnumber"]; ?></td>
                                            <td><?php echo $row["purok"]; ?></td>
                                            <td><?php echo $row["sitio"]; ?></td>
                                            <td><?php echo $row["street"]; ?></td>
                                            <td><?php echo $row["subdivision"]; ?></td>
                                            <td><?php echo $row["contactnumber"]; ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                            <td><?php echo $row["religion"]; ?></td>
                                            <td><?php echo $row["occupation"]; ?></td>
                                            <td><?php echo $row["educational"]; ?></td>
                                            <td><?php echo $row["nationality"]; ?></td>
                                            <td><?php echo $row["disability"]; ?></td>
                                            <td style ="text-align:center;"><div style ="width: 255px;" class="btn btn-outline-<?php if($row["status"]=='accepted'){echo 'success';} else {
                                            echo 'primary';
                                        }
                                        ?>"><?php echo $row["status"]; ?></div></td>
                                            <td><button data-id="<?php echo $row['id']; ?>" class="userinfo btn btn-primary">View</button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
                        <li class="page-item"><a class="page-link text-dark" href="residency_application.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="residency_application.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="residency_application.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Application Modal-->
    <div class="modal fade modal-lg" id="appModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        </div>
    </div>
    <!--Import Modal-->
    <div class="modal fade modal-md" id="impModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                $.ajax({url: "application_details.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#appModal').modal('show');
            });
        });
    </script>
    <!-- Import CSV script-->
    <script>
        $(document).ready(function(){
            $('.import').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "import_form.php",
                method:'post',
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#impModal').modal('show');
            });
        });
    </script>
    <!-- Export CSV-->
    <script>
        var data = "data:text/csv;charset=utf-8,";

        $(document).ready(function(){
            exportToCSV(0,<?php echo $numRows ?>);
        });

        function exportToCSV(start, max){
            if (start > max){
                $("#response").html('<a href="'+data+'" download = "Registration Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "residency_application.php",
            method: 'POST',
            dataType: 'json',
            data: {start: start}, 
            
            success: function (response) {
                data += response.data;
                exportToCSV((start + 50), max);
            }});
        }
    </script>
    <!-- search resident-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#search").keypress(function(){
            $.ajax({
                type:'POST',
                url:'search.php',
                data:{
                name:$("#search").val(),
                },
                success:function(data){
                $("#output").html(data);
                }
            });
            });
        });
    </script>
</body>
</html>