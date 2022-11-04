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
    <title>Manage Household</title>
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
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">Barangay <?php
                                                                                                                            include("../../phpfiles/bgy_info.php");
                                                                                                                            echo $row[3];
                                                                                                                            ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            <li class=""><a href="../announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                
                <h2 class="text fs-5">Manage Household</h2>
                <p>In this module, you can manage your household information.</p>
                <?php
                    if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Successful!</h4>
                        <p><?php echo $_SESSION['message'];?></p>
                        
                    </div>
                    <?php
                    }
                    $_SESSION['message'] = '';
                    ?>
                <div class="card">
                   
                    <h5 class="card-header">Household Member List<button class="addmember btn btn-success" style="float: right"><i class="fa-solid fa-plus"></i></button></h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Resident ID</th>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $userid = $_SESSION['user_id'];
                                    //get household id
                                    $query = "SELECT id,household_ID FROM resident_table WHERE user_id = '$userid'";
                                    $result = $conn -> query($query);
                                    $row = $result->fetch_array();
                                    $householdID = $row['household_ID'];

                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    } else {
                                        $_GET['page'] = 1;
                                        $page = $_GET['page'];
                                    }
                                    
                                    $start = ($page-1) * 10;
                                    //select all members
                                    $query = "SELECT * FROM resident_table WHERE household_ID = '$householdID' LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(id) as id FROM resident_table WHERE household_ID = '$householdID';");
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
                                    while($row1 = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row1["id"]; ?></td>
                                        <td><?php echo $row1["fname"] . ' ' . $row1["mname"] . ' ' . $row1["lname"] . ' ' . $row1["suffix"]; ?></td>
                                        <td><?php echo $row1["gender"]; ?></td>
                                        <td><?php 
                                            $dateOfBirth = $row1["birthday"];
                                            $today = date("Y-m-d");
                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                            echo $diff->format('%y');
                                        ?></td>
                                        <td><button data-id="<?php echo $row1['id']; ?>" class="editmember btn btn-danger" <?php if($row1['id'] == $row['id']){ echo 'disabled';} ?>><i class="fa-solid fa-box-archive"></i></button></td>
                                    </tr>
                                    
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="manage_household.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="manage_household.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="manage_household.php?page=<?php echo $next;?>">Next</a></li>
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
    <!-- Add member script-->
    <script>
        $(document).ready(function(){
            $('.addmember').click(function(){
                $.ajax({url: "add_member_form.php",
                    
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
            $('.editmember').click(function(){
                var rid = $(this).data('id');
                $.ajax({url: "edit_member_form.php",
                method:'post',
                data: {rid:rid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
</body>
</html>