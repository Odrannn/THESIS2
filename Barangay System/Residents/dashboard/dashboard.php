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
    <meta name="viewport" content="width=device-width, initial-scale1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Boxicons CDN Link -->
</head>

<body>
    <div class="main_container d-flex">
        <div class="sidebar" id="side_nav" style="background: <?php
        include("../../phpfiles/bgy_info.php");
        echo $row[1];
        ?>">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class=fs-4><span class=""><img src="../../Admin/configuration/uploads/<?php
                include("../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "50" height ="50" class="img-thumbnail"></span><span class="text-white">  Barangay <?php
                                                                                                                            include("../../phpfiles/bgy_info.php");
                                                                                                                            echo $row[3];
                                                                                                                            ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            <li class=""><a href="../announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            <div class="dashboard_content px-3 py-4">
                <?php
                $query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $result = $conn -> query($query);
                $row = $result -> fetch_array();

                $query1 = "SELECT * FROM complaint_table WHERE sender_ID = '" . $row['id'] . "'";
                $result1 = $conn -> query($query1);
                $compcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM suggestion_table WHERE sender_ID = '" . $row['id'] . "'";
                $result1 = $conn -> query($query1);
                $sugcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM blotter_table WHERE complainant_ID = '" . $row['id'] . "'";
                $result1 = $conn -> query($query1);
                $blotcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM document_request WHERE resident_ID = '" . $row['id'] . "'";
                $result1 = $conn -> query($query1);
                $reqcount = mysqli_num_rows($result1);
                ?>

                <h2 class="text fs-5">Dashboard</h2>
                <h2 class="text fs-5">Welcome <?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']?></h2>
                <br>    

                <div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-sharp fa-solid fa-face-angry"  style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $compcount;?></h1> 
                                    <h5 class="card-title">Filed Complaints</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-lightbulb" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $sugcount;?></h1> 
                                    <h5 class="card-title">Sent Suggestions</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-handcuffs" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $blotcount;?></h1> 
                                    <h5 class="card-title">Filed Blotters </h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="card-title"><i class="fa-solid fa-file-invoice" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $reqcount;?></h1> 
                                    <h5 class="card-title">Requested Documents </h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <br>
                <h5 class="card-title">Quick Access</h5>   
                <br>
                <?php include('../../phpfiles/modules_available.php');
                    if($availability[0] == 'yes'){ ?>
                        <div class="dash card mb-3 me-2 hover-shadow " style="width: 18rem;display: inline-block;">
                            <a href="../file_case/file_complaint.php" class="text-decoration-none text-dark">
                            <img src="img/complaint2.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">File Case</h5>
                                <p class="card-text">Manage active and inactive complaints and other cases.</p>
                            </div></a>
                        </div>
                    <?php
                    }
                ?>
                <?php if($availability[3] == 'yes'){ ?>
                        <div class="dash card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../request_document/request_document.php" class="text-decoration-none text-dark">
                            <img src="img/request.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Request Document</h5>
                                <p class="card-text">Manage all of the documents being requested.</p>
                            </div></a>
                        </div>
                        <?php
                    }
                ?>
                <?php
                //get resident id
                $rquery = "SELECT * FROM resident_table WHERE user_id = '". $_SESSION['user_id'] ."'";
                $rresult = $conn -> query($rquery);
                $rrow = $rresult -> fetch_assoc();

                $query = "SELECT * FROM tblhousehold WHERE household_head_ID = '" . $rrow['id'] . "' AND status = 'active'";
                $result = $conn -> query($query);
                if (mysqli_num_rows($result)>0){?>
                <div class="dash card mb-3 me-2 hover-shadow " style="width: 18rem;display: inline-block;">
                    <a href="../manage_household/manage_household.php" class="text-decoration-none text-dark">
                    <img src="img/house1.jpg" class="card-img-top" style="filter: brightness(50%);">
                    <div class="card-body">
                        <h5 class="card-title">Household Management</h5>
                        <p class="card-text">Manage household information and members.</p>
                    </div></a>
                </div>
                <?php
                }
                ?>
                
                <?php include('../../phpfiles/healthcare_time.php');?>
                <div class="card mb-3 me-2" id="health">
                    <div class="container-fluid">
                        <div class="status">
                            <?php
                            $timestamp = $rowh[1];
                            $start = date("g:i a",strtotime($timestamp));
                            $timestamp = $rowh[2];
                            $end = date("g:i a",strtotime($timestamp));
                            ?>
                            <h1>Healthcare Center Availability</h1>
                            <h3>Time Available: <br><?php echo $start; ?> - <?php echo $end; ?></h3>
                        </div>
                    </div>
                </div>
                
                <!--<hr>
                <div class="d-flex justify-content-center">
                    <h2 class="text fs-5" >Announcements</h2>
                </div>

                
                <hr>
                <?php
                    $query = "SELECT * FROM announcement WHERE status = 'active'  ORDER BY id DESC";
                    $result = $conn -> query($query);
                    

                    while($row = $result->fetch_assoc()) {
                ?>
                    
                    <div class="card mb-3 me-2">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <img src="../../announcement_uploads/<?php echo $row['img_url'];
                                ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['title'];?></h5>
                                    <p class="card-text"><?php echo $row['descrip'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>-->
            </div>
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
        $(document).ready(function() {
        // executes when HTML-Document is loaded and DOM is ready
        console.log("document is ready");
        

        $( ".dash" ).hover(
        function() {
            $(this).addClass('shadow').css('cursor', 'pointer'); 
        }, function() {
            $(this).removeClass('shadow');
        }
        );
        
        // document ready  
        });
    </script>
</body>
</html>