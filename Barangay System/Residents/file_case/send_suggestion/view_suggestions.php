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
    <title>Send Suggestion</title>
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
                <h1 class=fs-4><span class=""><img src="../../../Admin/configuration/uploads/<?php
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
                <li class=""><a href="../file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
                <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
                <li class=""><a href="../file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
                <?php 
                include('../../../phpfiles/modules_available.php');
                if($availability[3] == 'yes'){ ?>
                <li class=""><a href="../../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
                <?php }?>
                <li class=""><a href="../../announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class=""><img src="../../../Admin/configuration/uploads/<?php
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
                        //GET RESIDENT ID
                        $queryR = "SELECT * FROM resident_table WHERE user_id = '".$_SESSION['user_id']."';";
                        $resultR = $conn -> query($queryR);
                        $rowR = $resultR->fetch_assoc();
                        $residentID = $rowR['id'];

                        $query2 = "SELECT * FROM user_notification WHERE resident_ID = '$residentID' ORDER BY notification_ID DESC;";
                        $result2 = $conn -> query($query2);
                        $count1 = mysqli_num_rows($result2);

                        $queryc = "SELECT * FROM user_notification WHERE status = '0' AND resident_ID = '$residentID'";
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
                                    <?php 
                                    if($count1 != 0){
                                        while($rownot = $result2->fetch_assoc()){
                                            $timestamp = $rownot['date_time'];
                                            $dateTime = date("M d, Y, g:i a",strtotime($timestamp));

                                            $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                                            $result1 = $conn -> query($query1);
                                            $row1 = $result1->fetch_assoc();
                                            if($rownot['status'] == '0'){ 
                                                $notifID = $rownot['notification_ID'];?>
                                                <li><a class="dropdown-item " href="../../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
                                                <b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
                                                <?php echo $rownot['message']; ?><br>
                                                <b class="text-primary"><?php echo $dateTime;?></b>
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                        <?php 
                                            } else {
                                                $notifID = $rownot['notification_ID'];?>
                                                <li ><a class="dropdown-item" href="../../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
                                                <?php echo $rownot['notification_type'];?><br>
                                                <?php echo $rownot['message']; ?><br>
                                                <?php echo $dateTime;?>

                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                            <?php   
                                            }
                                        }
                                    } else {?>
                                        <li ><p class="dropdown-item">No notification right now.</p></li>
                                    <?php 
                                    }?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
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
                        <a href="../file_complaint.php"class="btn btn-outline-dark">Complaints</an>
                        <a href="#" class="btn btn-outline-dark active">Suggestion</a>
                        <a href="../file_blotter/file_blotter.php" class="btn btn-outline-dark">Blotter</a>
                    </div>
                </div>
                <br>
                <h2 class="fs-5">Send Suggestion</h2>
                <p>In this module, barangay residents can submit suggestions for enhancing their community. Public suggestions are easily accessible to the barangay.</p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="send_suggestion.php">Create Suggestion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">View Suggestions</a>
                    </li>
                </ul>
                <br>
                <div class="card">
                    <h5 class="card-header">Suggestion List</h5>
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
                                            <th>Suggestion ID</th>
                                            <th>Suggestion Nature</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Feedback</th>
                                            <th style ="text-align:center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "output">
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
                                    $query = "SELECT * FROM suggestion_table WHERE sender_ID = '$residentID' ORDER BY suggestion_ID DESC LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table WHERE sender_ID = '$residentID'");
                                    $sugCount = $result1->fetch_assoc();
                                    $total = $sugCount['id'];
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
                                        <td><?php echo $row1["suggestion_ID"]; ?></td>
                                        <td><?php echo $row1["suggestion_nature"]; ?></td>
                                        <td><?php echo $row1["suggestion_desc"]; ?></td>
                                        <td><?php echo $row1["suggestion_date"]; ?></td>
                                        <td><?php echo $row1["suggestion_feedback"]; ?></td>
                                        <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row1["suggestion_status"]=='noticed'){echo 'success';}
                                        else if($row1["suggestion_status"]=='pending'){
                                            echo 'primary';
                                        }
                                        ?>"><?php echo $row1["suggestion_status"]; ?></td>
                                        <td><button data-id="<?php echo $row1["suggestion_ID"]?>" class="viewsugg btn btn-primary"><i class="fa-solid fa-eye"></i></button>   
                                        </td>
                                    </tr>
                                    
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="view_suggestions.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="view_suggestions.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="view_suggestions.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!--view Modal-->
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
    <!-- view script-->
    <script>
        $(document).ready(function(){
            $('.viewsugg').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "view_suggestions_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewModal').modal('show');
            });
        });
    </script>
    <!-- search user-->
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