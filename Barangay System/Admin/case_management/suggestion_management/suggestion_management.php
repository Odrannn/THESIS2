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

    <?php $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table GROUP BY suggestion_nature;";
                    $result1 = $conn -> query($query1);?>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
          while($row1 = $result1 -> fetch_array()){
            ?>
            ['<?php echo $row1[1];?>',    <?php echo $row1[0];?>],
            <?php 
            } ?>
          ['none',    0]
        ]);

        var options = {
          pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
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
                                    <i class="fa-solid fa-bell px-2"></i>
                                    <span class="bg-danger rounded-pill text-white badge" style = "position:relative;top:-10px;left:-20px;"><?php echo $count?></span>
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
                        <a href="../case_management.php"class="btn btn-outline-dark">Complaints</an>
                        <a href="#" class="btn btn-outline-dark active">Suggestion</a>
                        <a href="../blotter_management/blotter_management.php" class="btn btn-outline-dark">Blotter</a>
                    </div>
                </div>
                <br>
                <h2 class="fs-5">Suggestion Management</h2>
                <p>The Suggestion module compiles every suggestion submitted by barangay residents. It has a function that enables barangay officials to look at the overall number
                    of suggestions that have been submitted to them, the number of pending ideas so they can understand which topics the barangay is most concerned about,
                    and the number of issues that have been resolved.</p>
                
                <div id="donutchart" style="width: 500px; height: 300px;display: inline-block;  vertical-align:top;"></div>
                <div style="display: inline-block; vertical-align:top;">
                    <table class="table table-borderless">
                        <tr>
                            <td><h5>Most Suggested</h5></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <table>
                                <?php
                                    include('../../../phpfiles/case_option.php');
                                    while($row = $result -> fetch_array()){

                                    if($row["suggestion_nature"] != ''){ ?>

                                    <form action="delete_option.php" method="post">
                                        <tr>
                                        <td><?php echo $row["suggestion_nature"]; ?></td>
                                        <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                        <td><input class="btn btn-danger mx-3" type='submit' name='delete_option' value='Delete'></td>
                                        </tr>
                                    </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <form action="../add_option.php" method="post">
                                <td><input class="form-control" type="text" name= "suggestion" placeholder="enter nature...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_suggestion" value="Add">
                                </div></td>
                            </form>
                        </tr>
                    </table>   
                </div> 
                    
                <?php $comp_query1 = "SELECT COUNT(suggestion_ID) FROM suggestion_table;";
                    $comp_result1 = $conn -> query($comp_query1);
                    $comp_row1 = $comp_result1 -> fetch_array();
                    $total = $comp_row1[0];
                    
                    $comp_query2 = "SELECT COUNT(suggestion_ID) FROM suggestion_table WHERE suggestion_status = 'pending';";
                    $comp_result2 = $conn -> query($comp_query2);
                    $comp_row2 = $comp_result2 -> fetch_array();
                    $pending = $comp_row2[0];?>
                
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="card mb-3 me-2 bg-primary" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-solid fa-lightbulb"></i>&nbsp;<h5 class="d-inline">Total: <?php echo $total;?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-warning" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-sharp fa-solid fa-spinner"></i>&nbsp;<h5 class="d-inline">Pending: <?php echo $pending;?></h5>
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
                                            <th>Suggestion ID</th>
                                            <th>Official in Charge</th>
                                            <th>Sender ID</th>
                                            <th>Nature</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Feedback</th>
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
                                    $query = "SELECT * FROM suggestion_table ORDER BY suggestion_ID DESC LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table;");
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
                                        <td><?php echo $row["suggestion_ID"]; ?></td>
                                        <td><?php echo $row["official_ID"]; ?></td>
                                        <td><?php echo $row["sender_ID"]; ?></td>
                                        <td><?php echo $row["suggestion_nature"]; ?></td>
                                        <td><?php echo $row["suggestion_desc"]; ?></td>
                                        <td><?php echo $row["suggestion_date"]; ?></td>
                                        <td><?php echo $row["suggestion_feedback"]; ?></td>
                                        <td><?php echo $row["suggestion_status"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['suggestion_ID']; ?>" class="sendfeedback btn btn-primary"><i class="fa-solid fa-reply"></i></button>
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
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
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
    <!-- Edit suggestion script-->
    <script>
        $(document).ready(function(){
            $('.sendfeedback').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "reply_suggestion_form.php",
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