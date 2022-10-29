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
        $resultm = $conn -> query("SELECT * FROM blotter_table LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            $allData .= $row["blotter_ID"] . ',' . $row["official_ID"] . ',' . $row["complainant_ID"] . ',' . $row["complainee_ID"] . ',' . $row["complainee_name"] . ',' . 
            $row["blotter_date"] . ',' . $row["blotter_time"] . ',' . $row["blotter_accusation"] . ',' . $row["blotter_details"] . ',' .  $row["settlement_schedule"] . ',' . 
            $row["settlement_time"] . ',' . $row["result_of_settlement"] . ',' . $row["status"] . ',' . "\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT blotter_ID FROM blotter_table;");
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
                <div class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a href="../case_management.php"class="btn btn-outline-dark">Complaints</an>
                        <a href="../suggestion_management/suggestion_management.php" class="btn btn-outline-dark">Suggestion</a>
                        <a class="btn btn-dark">Blotter</a>
                    </div>
                </div>
                <br>
                <h2 class="fs-5">Blotter Management</h2>
                <p>Every blotter that is issued in the barangay is compiled by the blotter module, which also contains a function that allows barangay
                    authorities to see how many blotters have been submitted in total, how many cases are still pending, and how many issues have been resolved.
                    It's essential to have a copy of the closed blotter file so they may save it as documentation.</p>
                
                <div class="d-flex justify-content-center">
                    <?php 
                    $query1 = "SELECT COUNT(blotter_ID) AS Total, status FROM blotter_table  GROUP BY status;";
                    $result1 = $conn -> query($query1);
                    $sched = 0;
                    $unsched = 0;
                    $settled = 0;
                    $unsettled = 0;

                    while($row = $result1 -> fetch_array()){
                        if($row['status'] == 'unscheduled'){
                            $unsched = $row[0];
                        } else if($row['status'] == 'scheduled'){
                            $sched = $row[0];
                        } else if($row['status'] == 'settled'){
                            $settled = $row[0];
                        } else if($row['status'] == 'unsettled'){
                            $unsettled = $row[0];
                        }
                    }
                    
                    ?>
                    <div>
                        <div class="card mb-3 me-2 bg-success" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-hand-peace"></i>&nbsp;<h5 class="d-inline">Settled: <?php echo $settled;?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-danger" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-thumbs-down"></i>&nbsp;<h5 class="d-inline">Unsettled: <?php echo $unsettled;?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-primary" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-calendar-days"></i>&nbsp;<h5 class="d-inline">Scheduled: <?php echo $sched;?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-warning" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-calendar-circle-exclamation"></i>&nbsp;<h5 class="d-inline">Unscheduled: <?php echo $unsched; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                if (isset($_SESSION["importBlotter"])){
                    if($_SESSION["importBlotter"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importBlotter"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importBlotter"] = "";
                }
                ?>
                <div class="card">
                    <h5 class="card-header">Blotter Records</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Blotter ID</th>
                                            <th>Official in Charge</th>
                                            <th>Complainant ID</th>
                                            <th>Complainee ID</th>
                                            <th>Complainee Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Accusation</th>
                                            <th>Details</th>
                                            <th>Settlement Schedule</th>
                                            <th>Settlement Time</th>
                                            <th>Result of Settlement</th>
                                            <th style ="text-align:center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    } else {
                                        $_GET['page'] = 1;
                                        $page = $_GET['page'];
                                    }
                                    
                                    $start = ($page-1) * 10;
                                    $query = "SELECT * FROM blotter_table ORDER BY blotter_ID DESC LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(blotter_ID) as id FROM blotter_table;");
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
                                    while($row = $result->fetch_assoc()){ ?>

                                    
                                    <tr>
                                        <td><?php echo $row["blotter_ID"]; ?></td>
                                        <td><?php echo $row["official_ID"]; ?></td>
                                        <td><?php echo $row["complainant_ID"]; ?></td>
                                        <td><?php echo $row["complainee_ID"]; ?></td>
                                        <td><?php echo $row["complainee_name"]; ?></td>
                                        <td><?php echo $row["blotter_date"]; ?></td>
                                        <td><?php echo $row["blotter_time"]; ?></td>
                                        <td><?php echo $row["blotter_accusation"]; ?></td>
                                        <td><?php echo $row["blotter_details"]; ?></td>
                                        <td><?php echo $row["settlement_schedule"]; ?></td>
                                        <td><?php echo $row["settlement_time"]; ?></td>
                                        <td><?php echo $row["result_of_settlement"]; ?></td>
                                        <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row["status"]=='settled'){echo 'success';}
                                        else if($row["status"]=='unscheduled'){
                                            echo 'warning';
                                        } else if($row["status"]=='scheduled'){
                                            echo 'primary';
                                        } else {
                                            echo 'danger';
                                        }
                                        ?>"><?php echo $row["status"]; ?></div></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <?php $off_id = $row['official_ID'];
                                                $query2 = "SELECT * FROM tblofficial WHERE official_id = '$off_id'";
                                                $result2 = $conn -> query($query2); 
                                                $row2 = mysqli_fetch_array($result2)
                                            ?>
                                            <button data-id="<?php echo $row['blotter_ID']; ?>" class="setsched btn btn-primary"<?php 
                                                if($off_id != ""){
                                                    if($row['status'] == 'settled' || $row['status'] == 'unsettled' || $row2['user_id'] != $_SESSION['user_id'])
                                                    {
                                                        echo "disabled"; 
                                                    }
                                                } ?>><i class="fa-solid fa-calendar-days"></i></button>
                                            <button data-id="<?php echo $row['blotter_ID']; ?>" class="editblotter btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
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
                        <li class="page-item"><a class="page-link text-dark" href="blotter_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="blotter_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="blotter_management.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--set schedule modal-->
    <div class="modal fade modal-md" id="setModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- set schedule script-->
    <script>
        $(document).ready(function(){
            $('.setsched').click(function(){
                var blotterid = $(this).data('id');
                $.ajax({url: "set_schedule_form.php",
                method:'post',
                data: {blotterid:blotterid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#setModal').modal('show');
            });
        });
    </script>
    <!-- Edit resident script-->
    <script>
        $(document).ready(function(){
            $('.editblotter').click(function(){
                var blotterid = $(this).data('id');
                $.ajax({url: "edit_blotter_form.php",
                method:'post',
                data: {blotterid:blotterid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
    <!--Import Modal-->
    <div class="modal fade modal-md" id="impModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>
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
                $("#response").html('<a href="'+data+'" download = "Blotter Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "blotter_management.php",
            method: 'POST',
            dataType: 'json',
            data: {start: start}, 
            
            success: function (response) {
                data += response.data;
                exportToCSV((start + 50), max);
            }});
        }
    </script>
</body>
</html>