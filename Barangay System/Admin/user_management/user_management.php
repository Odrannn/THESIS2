<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
}

$query = "SELECT * FROM tbluser WHERE id = '".$_SESSION['user_id']."'";
$result = $conn -> query($query); 
$row1 = mysqli_fetch_array($result);

if($row1['type'] == 'user') {
    header("location:../../Residents/dashboard/dashboard.php");
}
?>
<?php
    if (isset($_POST['start'])){
        $start = $conn -> real_escape_string($_POST['start']);

        $allData = '';
        $resultm = $conn -> query("SELECT * FROM tbluser LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            $allData .= $row["id"] . ',' . $row["username"] . ',' . $row["password"] . ',' . $row["type"] . ',' . $row["profile"] . ',' . "\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT id FROM tbluser;");
    $numRows = mysqli_num_rows($sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
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
            <li class=""><a href="../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
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
            <li class="active"><a href="../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
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
                <h2 class="fs-5">User Management</h2>
                <p>The barangay administrator or the barangay captain can simply change the information for any user who has registered on the website,
                    including accounts for residents or officials, in this module.</p>

                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $_GET['page'] = 1;
                        $page = $_GET['page'];
                    }
                    
                    $start = ($page-1) * 10;
                    $query = "SELECT U.*, S.fname, S.mname, S.lname, S.suffix FROM tbluser U INNER JOIN resident_table S ON U.id = S.user_id ORDER BY U.id DESC LIMIT $start, 10;";
                    $result = $conn -> query($query);

                    $result1 = $conn -> query("SELECT count(id) as id FROM tbluser;");
                    $uCount = $result1->fetch_assoc();
                    $total = $uCount['id'];
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

                    $query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
                    $result1 = $conn -> query($query1);
                    $row1 = $result1 -> fetch_array();
                    $typeOfUser = $row1['type'];
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
                if (isset($_SESSION["importUser"])){
                    if($_SESSION["importUser"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importUser"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importUser"] = "";
                }
                ?>
                <div class="card">
                    <h5 class="card-header">User List<button class="adduser btn btn-success" style="float: right">Add</button></h5>
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
                                            <th>Full name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Type</th>
                                            <th style ="text-align:center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "output">
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"]; ?></td>
                                        <td><?php echo $row["username"]; ?></td>
                                        <td><?php echo $row["password"]; ?></td>
                                        <td><?php echo $row["type"]; ?></td>
                                        <td style ="text-align:center;"><div style ="width: 120px;" class="btn btn-outline-<?php if($row["status"]=='active'){echo 'success';} else {
                                            echo 'danger';
                                        }
                                        ?>"><?php echo $row["status"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row['id']; ?>" class="edituser btn btn-warning" <?php if($row["status"]=='inactive'){echo 'disabled';} ?>
                                            <?php if($row["type"] != 'user' && $row["type"] != 'hadmin' && $typeOfUser != 'admin0' || $typeOfUser == 'hadmin'){ echo 'disabled';}?>><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
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
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <div><a class="import btn btn-outline-success">Import</a></div>
                        <div id="response">Please wait..</div>
                    </div>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="user_management.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="user_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="user_management.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Add Modal-->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            
        </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade modal-md" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <!-- Add user script-->
    <script>
        $(document).ready(function(){
            $('.adduser').click(function(){
                $.ajax({url: "add_form.php",
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#addModal').modal('show');
            });
        });
    </script>
    <!-- Edit user script-->
    <script>
        $(document).ready(function(){
            $('.edituser').click(function(){
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
    <!-- Export CSV-->
    <script>
        var data = "data:text/csv;charset=utf-8,";

        $(document).ready(function(){
            exportToCSV(0,<?php echo $numRows ?>);
        });

        function exportToCSV(start, max){
            if (start > max){
                $("#response").html('<a href="'+data+'" download = "User Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "user_management.php",
            method: 'POST',
            dataType: 'json',
            data: {start: start}, 
            
            success: function (response) {
                data += response.data;
                exportToCSV((start + 50), max);
            }});
        }
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