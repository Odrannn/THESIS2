<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
}

?>
<?php
    if (isset($_POST['start'])){
        $start = $conn -> real_escape_string($_POST['start']);

        $allData = '';
        $resultm = $conn -> query("SELECT * FROM complaint_table LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            $allData .= $row["complaint_ID"] . ',' . $row["official_ID"] . ',' . $row["sender_ID"] . ',' . $row["complaint_nature"] . ',' . $row["comp_desc"] . ',' . $row["complaint_date"] . ',' . $row["img_proof"] . ',' . $row["complaint_status"] . ',' . "\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT complaint_ID FROM complaint_table;");
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
        include("../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class=""><img src="../configuration/uploads/<?php
                include("../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "50" height ="50" class="img-thumbnail"></span><span class="text-white">  Barangay <?php
                                                                                                                                    include("../../phpfiles/bgy_info.php");
                                                                                                                                    echo $row[3];
                                                                                                                                    ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <?php 
            include('../../phpfiles/modules_available.php');
            if($availability[0] == 'yes'){ ?>
            <li class="active"><a href="../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
            <?php } 
            if($availability[1] == 'yes'){ ?>
            <li class=""><a href="../resident_management/resident_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-people-group"></i>&nbsp;Resident</a></li>
            <?php } 
            if($availability[3] == 'yes'){ ?>
            <li class=""><a href="../document_request/document_request.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-invoice"></i>&nbsp;Request</a></li>
            <?php } 
            if($availability[4] == 'yes'){ ?>
            <li class=""><a href="../official_management/official_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-image-portrait"></i>&nbsp;Official</a></li>
            <?php } 
            if($availability[5] == 'yes'){ ?>
            <li class=""><a href="../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
            <?php } 
            if($availability[6] == 'yes'){ ?>
            <li class=""><a href="../reports/report.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-newspaper"></i>&nbsp;Reports</a></li>
            <?php } ?>
            <hr class="text-light">
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
                            <a class="btn btn-dark">Complaints</an>
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
                                <td><input class="form-control" type="text" name= "complaint" oninput="this.value = this.value.replace(/[^a-z ]/gi, '').replace(/(\..*)\./gi, '$1')" placeholder="enter nature...">
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
                if (isset($_SESSION["importComplaint"])){
                    if($_SESSION["importComplaint"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importComplaint"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importComplaint"] = "";
                }
                ?>
                <div class="card">
                    <h5 class="card-header">Complaint Records</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div>
                                <!--Filter -->
                                <div class="row">
                                    <div class="col-md pt-2">
                                        <select class="form-control w-50" name="filter" id="filter">
                                            <option value="all"<?php
                                            if(isset($_SESSION['filter'])){
                                                if($_SESSION['filter'] == 'all'){
                                                    echo 'selected';
                                                }
                                            } else {
                                                echo 'selected';
                                            }
                                            ?>>All</option>
                                            <option value="day"<?php
                                            if(isset($_SESSION['filter'])){
                                                if($_SESSION['filter'] == 'day'){
                                                    echo 'selected';
                                                }
                                            }?>>This Day</option>
                                            <option value="week" <?php
                                            if(isset($_SESSION['filter'])){
                                                if($_SESSION['filter'] == 'week'){
                                                    echo 'selected';
                                                }
                                            }?>>This Week</option>
                                            <option value="month" <?php
                                            if(isset($_SESSION['filter'])){
                                                if($_SESSION['filter'] == 'month'){
                                                    echo 'selected';
                                                }
                                            }?>>This Month</option>
                                            <option value="year" <?php
                                            if(isset($_SESSION['filter'])){
                                                if($_SESSION['filter'] == 'year'){
                                                    echo 'selected';
                                                }
                                            }?>>This Year</option>
                                        </select>
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                    <div class="col-md pt-2">
                                    </div>
                                    <div class="col-md pt-2">
                                        <input type="text" class="form-control" id="search" placeholder="Enter Keyword...">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="tableContainer table-responsive" style="width: 100%;">
                            <?php 
                            if(isset($_SESSION['filter'])){
                                if($_SESSION['filter']=='day'){
                                    $currentDate = date("Y-m-d");
                                    $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table WHERE complaint_date = '$currentDate' GROUP BY complaint_nature;";
                                } else if($_SESSION['filter']=='week'){
                                    $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table WHERE WEEK(complaint_date) = WEEK(now()) GROUP BY complaint_nature;";
                                } else if($_SESSION['filter']=='month'){
                                    $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table WHERE MONTH(complaint_date) = MONTH(now()) GROUP BY complaint_nature;";
                                } else if($_SESSION['filter']=='year'){
                                    $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table WHERE YEAR(complaint_date) = YEAR(now()) GROUP BY complaint_nature;";
                                } else {
                                    $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table GROUP BY complaint_nature;";
                                }
                            } else {
                                $query1 = "SELECT COUNT(complaint_ID) AS Total, complaint_nature FROM complaint_table GROUP BY complaint_nature;";
                            }
                            $result1 = $conn -> query($query1);?>
                            <script type="text/javascript">
                            google.charts.load("current", {packages:["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                <?php
                                $otherTotal = 0;
                                
                                while($row1 = $result1 -> fetch_array()){
                                    $exist = 0;
                                    include('../../phpfiles/case_option.php');
                                    while($row = $result -> fetch_array()){
                                    if($row1[1] == $row['complaint_nature']){
                                        $exist = 1;?>
                                        
                                    ['<?php echo $row1[1];?>',    <?php echo $row1[0];?>],
                                    <?php 
                                        } 
                                    }
                                    if($exist == 0){
                                        $otherTotal += $row1[0];
                                    }
                                }?>
                                ['Other',    <?php echo $otherTotal;?>]
                                ]);

                                var options = {
                                pieHole: 0.4
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                chart.draw(data, options);
                            }
                            </script>
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
                                            <th style ="text-align:center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "output">
                                    <?php 
                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    } else {
                                        $_GET['page'] = 1;
                                        $page = $_GET['page'];
                                    }
                                    
                                    $start = ($page-1) * 10;
                                    $query = "SELECT * FROM complaint_table ORDER BY complaint_ID DESC LIMIT $start, 10;";

                                    if(isset($_SESSION['filter'])){
                                        if($_SESSION['filter']=='day'){
                                            $currentDate = date("Y-m-d");
                                            $query = "SELECT * FROM complaint_table WHERE complaint_date = '$currentDate' ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                            $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table WHERE complaint_date = '$currentDate';");
                                            
                                        } else if($_SESSION['filter']=='week'){
                                            $query = "SELECT * FROM complaint_table WHERE WEEK(complaint_date) = WEEK(now()) ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                            $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table WHERE WEEK(complaint_date) = WEEK(now());");
                                        } else if($_SESSION['filter']=='month'){
                                            $query = "SELECT * FROM complaint_table WHERE MONTH(complaint_date) = MONTH(now()) ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                            $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table WHERE MONTH(complaint_date) = MONTH(now());");
                                        } else if($_SESSION['filter']=='year'){
                                            $query = "SELECT * FROM complaint_table WHERE YEAR(complaint_date) = YEAR(now()) ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                            $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table WHERE YEAR(complaint_date) = YEAR(now());");
                                        } else if($_SESSION['filter']=='all'){
                                            $query = "SELECT * FROM complaint_table ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                            $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table;");
                                        }
                                    } else {
                                        $query = "SELECT * FROM complaint_table ORDER BY complaint_ID DESC LIMIT $start, 10;";
                                        $result1 = $conn -> query("SELECT count(complaint_ID) as id FROM complaint_table;");
                                    }
                                    
                                    $result = $conn -> query($query);
                                    $count = mysqli_num_rows($result);

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
                                        <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row["complaint_status"]=='solved'){echo 'success';}
                                        else if($row["complaint_status"]=='pending'){
                                            echo 'primary';
                                        }
                                        ?>"><?php echo $row["complaint_status"]; ?></div></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['complaint_ID']; ?>" class="editcomplaint btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                                    <div><a class="import btn btn-outline-success">Import</a></div>
                                    <div id="response">Please wait..</div>
                                </div>
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
                            <?php $_SESSION['filter']='all';?>
                        </div>
                    </div>
                </div><br>
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
                $.ajax({
                url: "edit_complaint_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
    <!--Filter-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#filter").on('change',function(){
                var value = $(this).val();

                $.ajax({
                    url: "filter.php",
                    method: "POST",
                    data: {request:value},

                    beforeSend:function(){
                        $(".tableContainer").html("<span>Working...</span>");
                    },
                    success:function(data){
                        $(".tableContainer").html(data);
                    }
                });
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
                $("#response").html('<a href="'+data+'" download = "Complaint Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "case_management.php",
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