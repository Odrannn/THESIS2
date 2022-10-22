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
        $resultm = $conn -> query("SELECT * FROM tblhousehold LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            $allData .= $row["household_id"] . ',' . $row["household_member"] . ',' . $row["household_head_ID"] . ',' . $row["household_name"] . ',' . $row["status"] . ',' . "\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT household_id FROM tblhousehold;");
    $numRows = mysqli_num_rows($sql);
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

                                        $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                                        $result1 = $conn -> query($query1);
                                        $row1 = $result1->fetch_assoc();
                                        $name = $row1['fname'] . " " . $row1['lname'];
                                        if($rownot['status'] == '0'){ 
                                            $notifID = $rownot['notification_ID'];?>

                                            <li><a class="dropdown-item " href="../../../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
                                            <b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
                                            <?php echo $name . " " . $rownot['message']; ?><br>
                                            <b class="text-primary"><?php echo $dateTime;?></b>
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                    <?php 
                                        } else {
                                            $notifID = $rownot['notification_ID'];?>
                                            <li><a class="dropdown-item" href="../../../phpfiles/readnotif.php?notifid=<?php echo $notifID?>">
                                            <?php echo $rownot['notification_type'];?><br>
                                            <?php echo $name . " " . $rownot['message']; ?><br>
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
                if (isset($_SESSION["importHousehold"])){
                    if($_SESSION["importHousehold"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importHousehold"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importHousehold"] = "";
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
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <div><a class="import btn btn-outline-success">Import</a></div>
                        <div id="response">Please wait..</div>
                    </div>
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
    <!-- Export CSV-->
    <script>
        var data = "data:text/csv;charset=utf-8,Household ID,Household Member,Head ID,Family Name, Status\n";

        $(document).ready(function(){
            exportToCSV(0,<?php echo $numRows ?>);
        });

        function exportToCSV(start, max){
            if (start > max){
                $("#response").html('<a href="'+data+'" download = "Household Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "household_management.php",
            method: 'POST',
            dataType: 'json',
            data: {start: start}, 
            
            success: function (response) {
                data += response.data;
                exportToCSV((start + 50), max);
            }});
        }
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
</body>
</html>