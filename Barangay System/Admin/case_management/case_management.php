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
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table GROUP BY complaint_nature;";
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
                <div class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a class="btn btn-outline-dark active">Complaints</an>
                        <a href="suggestion_management/suggestion_management.php" class="btn btn-outline-dark">Suggestion</a>
                        <a href="blotter_management/blotter_management.php" class="btn btn-outline-dark">Blotter</a>
                    </div>
                </div>
                <br>
                
                <h2 class="fs-5">Complaint Management</h2>
                <p>This module contains a list of every complaint filed by barangay residents.
                    It has a feature that enables barangay officials to see the overall number of complaints sent to them,
                    the number of pending complaints so they can see what issues still need to be fixed, and the number
                    of resolved complaints.</p>
                
                <div id="donutchart" style="width: 500px; height: 300px;display: inline-block;  vertical-align:top;"></div>
                <div style="display: inline-block; vertical-align:top;">
                    <table class="table table-borderless">
                        <tr>
                            <td><h5>Most Complained</h5></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <table>
                                <?php
                                    include('../../phpfiles/case_option.php');
                                    while($row = $result -> fetch_array()){

                                    if($row["complaint_nature"] != ''){ ?>

                                    <form action="delete_option.php" method="post">
                                        <tr>
                                        <td><?php echo $row["complaint_nature"]; ?></td>
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
                            <form action="add_option.php" method="post">
                                <td><input class="form-control" type="text" name= "complaint" placeholder="enter nature...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_option" value="Add">
                                </div></td>
                            </form>
                        </tr>
                    </table>   
                </div> 
                    
                <?php $comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved';";
                    $comp_result1 = $conn -> query($comp_query1);
                    $comp_row1 = $comp_result1 -> fetch_array();
                    $solved = $comp_row1[0];
                    
                    $comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending';";
                    $comp_result2 = $conn -> query($comp_query2);
                    $comp_row2 = $comp_result2 -> fetch_array();
                    $pending = $comp_row2[0];?>
                
                
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="card mb-3 me-2 bg-primary" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-sharp fa-solid fa-face-angry"></i>&nbsp;<h5 class="d-inline">Total: <?php echo $solved + $pending;?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-warning" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-sharp fa-solid fa-spinner"></i>&nbsp;<h5 class="d-inline">Pending: <?php echo $comp_row2[0];?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 me-2 bg-success" style="width: 18rem;display: inline-block;">
                            <div class="card-body">
                                <div class="d-inline text-white">
                                    <i class="fa-regular fa-circle-check"></i>&nbsp;<h5 class="d-inline">Solved: <?php echo $comp_row1[0];?> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <h5 class="card-header">Complaint Records</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div>
                                <div class="row">
                                    <div class="col-md pt-2">
                                        <select class="form-control w-50" name="filter" id="filter">
                                            <option value="" disabled selected>Select Filter</option>
                                            <option value="day">This Day</option>
                                            <option value="week">This Week</option>
                                            <option value="year">This Year</option>
                                        </select>
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Complaint ID</th>
                                            <th>Official in Charge</th>
                                            <th>Sender ID</th>
                                            <th>Nature</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Proof</th>
                                            <th>Status</th>
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
                                    $query = "SELECT * FROM complaint_table ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table;");
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
                                        <td><?php echo $row["complaint_ID"]; ?></td>
                                        <td><?php echo $row["official_ID"]; ?></td>
                                        <td><?php echo $row["sender_ID"]; ?></td>
                                        <td><?php echo $row["complaint_nature"]; ?></td>
                                        <td><?php echo $row["comp_desc"]; ?></td>
                                        <td><?php echo $row["complaint_date"]; ?></td>
                                        <td><?php echo $row["img_proof"]; ?></td>
                                        <td><?php echo $row["complaint_status"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['complaint_ID']; ?>" class="editcomplaint btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
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
                        <li class="page-item"><a class="page-link text-dark" href="case_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="case_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="case_management.php?page=<?php echo $next;?>">Next</a></li>
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
    <!-- Edit complaint script-->
    <script>
        $(document).ready(function(){
            $('.editcomplaint').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "edit_complaint_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#filter").on('change',function(){
                var value = $(this).val();
                alert(value);
            })
        })
    </script>
</body>
</html>