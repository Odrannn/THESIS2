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
    <title></title>
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
                <h1 class=fs-4><span class="bg-white text-dark rounded shadow px-2 me-2">BS</span><span class="text-white">Barangay <?php
                                                                                                                                    include("../../phpfiles/bgy_info.php");
                                                                                                                                    echo $row[3];
                                                                                                                                    ?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-file-lines"></i>&nbsp;File Received</span>
                <span class="bg-dark rounded-pill text-white py-0 px-2">02</span></a></li>
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
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
                    $query = "SELECT * FROM admin_notification";
                    $result = $conn -> query($query);
                    $count = mysqli_num_rows($result);
                    ?>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bell px-2"></i>
                                    <span class="bg-danger rounded-pill text-white badge" style = "position:relative;top:-10px;left:-20px;"><?php echo $count?></span>
                                </a>
                                <!--Notification-->
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php while($rownot = $result->fetch_assoc()){
                                        $timestamp = $rownot['date_time'];
                                        $dateTime = date("M d, Y, g:i a",strtotime($timestamp));

                                        $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                                        $result1 = $conn -> query($query1);
                                        $row1 = $result1->fetch_assoc();
                                        $name = $row1['fname'] . " " . $row1['lname']?>
                                        <li><a class="dropdown-item" href="#">
                                        <b><?php echo $rownot['notification_type']?></b><br>
                                        <?php echo $name . " " . $rownot['message'] ?><br>
                                        <b class="text-primary"><?php echo $dateTime?></b>

                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-user px-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="../../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="dashboard-content px-3 py-4">
                <?php
                $query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $result = $conn -> query($query);
                $row = $result -> fetch_array();
                ?>

                <h2 class="text fs-5">Dashboard</h2>
                <h2 class="text fs-5">Welcome <?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']?></h2>
                <br>
                <?php include('../../phpfiles/modules_available.php');
                    if($availability[0] == 'yes'){ ?>
                        <div class="card mb-3 me-2 hover-shadow " style="width: 18rem;display: inline-block;">
                            <a href="../case_management/case_management.php" class="text-decoration-none text-dark">
                            <img src="../icons/complaint2.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Case Management</h5>
                                <p class="card-text">Manage active and inactive complaints and other cases.</p>
                            </div></a>
                        </div>
                    <?php
                    }
                ?>
                <?php if($availability[1] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../resident_management/resident_management.php" class="text-decoration-none text-dark">
                            <img src="../icons/resident.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Resident and Household</h5>
                                <p class="card-text">Manage resident's profile within the barangay.</p>
                            </div></a>
                        </div>
                    <?php
                    }
                ?>
                <?php if($availability[2] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../healthcare_center/healthcare_center.php" class="text-decoration-none text-dark">
                            <img src="../icons/health.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Healthcare Center</h5>
                                <p class="card-text">Manage healthcare Center official announcements.</p>
                            </div></a>
                        </div>
                    <?php
                    }
                ?>
                <?php if($availability[3] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../document_request/document_request.php" class="text-decoration-none text-dark">
                            <img src="../icons/request.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Request Verification</h5>
                                <p class="card-text">Manage all of the documents being requested.</p>
                            </div></a>
                        </div>
                        <?php
                    }
                ?>
                <?php if($availability[4] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../official_management/official_management.php" class="text-decoration-none text-dark">
                            <img src="../icons/admin.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Officials Management</h5>
                                <p class="card-text">Manage the profile of the barangay officials.</p>
                            </div></a>
                        </div>
                        <?php
                    }
                ?>
                <?php if($availability[5] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../user_management/user_management.php" class="text-decoration-none text-dark">
                            <img src="../icons/user.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">User Management</h5>
                                <p class="card-text">Manage all of the users on the Barangay system.</p>
                            </div></a>
                        </div>
                        <?php
                    }
                ?>
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
        

        $( ".card" ).hover(
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