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
                <li class=""><a href="../file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
                <li class=""><a href="../send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
                <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
                <li class=""><a href="../../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
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
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-bell px-2"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="../../../Login/logout.php" class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
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
                        <a href="../send_suggestion/send_suggestion.php" class="btn btn-outline-dark">Suggestion</a>
                        <a class="btn btn-outline-dark active">Blotter</a>
                    </div>
                </div>
                <br>
                <h2 class="fs-5">File Blotter</h2>
                <p>In this module, Residents of the barangay may submit blotters or reports for specific events that occurred inside the boundaries of the barangay.</p>
                
                <div class="card mt-2">
                    <h5 class="card-header">Blotter Form</h5>
                    <div class="card-body">
                        <?php 
                        //alert message
                        if(isset($_SESSION['blotter_message']))
                        {
                            if($_SESSION['blotter_message'] != ''){?>
                            <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Blotter Sent Successfully!</h4>
                            <p><?php echo $_SESSION['blotter_message'];?></p>
                            </div> 
                        <?php }
                            $_SESSION['blotter_message'] = '';
                        } ?>
                        <form class="g-3" action="../send_case.php" method="post" enctype="multipart/form-data">
                            <?php
                                $query = "SELECT id, concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table
                                            ORDER BY Fullname ASC;";
                                $result = $conn -> query($query);
                            ?>
                            <div class="row">
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="complaineeID">Complainee ID (Search the name of the resident.)</label>
                                    <input class="form-control" type="text" id="complaineeID" name="complaineeID" list="reslist" required>
                                    <datalist id="reslist">
                                        <?php while($row = $result -> fetch_array()) { ?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['Fullname']?></option>
                                        <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="accusation">Accusation</label> 
                                    <input class="form-control" type="text" id= "accusation" name="accusation" rows="10" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md pt-2">
                                    <div class="form-floating">
                                        <input class="form-control" type="time" id="timeh" name="timeh" required>
                                        <label for="start">Incident Time</label>
                                    </div>
                                </div>
                                <div class="col-md pt-2">
                                    <div class="form-floating">
                                        <input class="form-control" type="date" id="dateh" name="dateh" required>
                                        <label for="date">Incident Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="details">Details</label>
                                    <textarea class="form-control" id= "details" name= "details" rows="10" required></textarea>
                                </div>
                            </div>
                            <br>
                            <p class="d-inline">Note: If complainee ID is not found, type the full name of the complainee.</p>
                            <div class="row mt-4 d-flex flex-row-reverse">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3" name="send_blotter" value="Send">Send</button>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
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
    <!-- Edit resident script-->
    <script>
        $(document).ready(function(){
            $('.editofficial').click(function(){
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