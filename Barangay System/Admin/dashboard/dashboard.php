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
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
            <li class=""><a href="../resident_management/resident_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-people-group"></i>&nbsp;Resident</a></li>
            <li class=""><a href="../document_request/document_request.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-invoice"></i>&nbsp;Request</a></li>
            <li class=""><a href="../official_management/official_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-image-portrait"></i>&nbsp;Official</a></li>
            <li class=""><a href="../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
            <li class=""><a href="../reports/report.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-newspaper"></i>&nbsp;Reports</a></li>
            <hr class="text-light">
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>

        <div class="content">
            <?php
            $query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
            $result1 = $conn -> query($query1);
            $row1 = $result1 -> fetch_array();
            $typeOfUser = $row1['type'];

            $query = "SELECT * FROM resident_table";
            $result = $conn -> query($query);
            $row = $result -> fetch_array();

            $query1 = "SELECT * FROM complaint_table";
            $result1 = $conn -> query($query1);
            $compcount = mysqli_num_rows($result1);

            $query1 = "SELECT * FROM suggestion_table";
            $result1 = $conn -> query($query1);
            $sugcount = mysqli_num_rows($result1);

            $query1 = "SELECT * FROM blotter_table WHERE status != 'cancelled';";
            $result1 = $conn -> query($query1);
            $blotcount = mysqli_num_rows($result1);

            $query1 = "SELECT * FROM document_request WHERE status != 'cancelled';";
            $result1 = $conn -> query($query1);
            $reqcount = mysqli_num_rows($result1);
            ?>
            <?php include("../../phpfiles/official_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <?php
                $query = "SELECT * FROM resident_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $result = $conn -> query($query);
                $row = $result -> fetch_array();
                ?>

                <h2 class="text fs-5">Dashboard</h2>
                <h2 class="text fs-5">Welcome <?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']?></h2>
                <br>
                <h5 class="card-title">Transactions Summary</h5>   
                <br>
                <div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-sharp fa-solid fa-face-angry"  style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $compcount;?></h1> 
                                    <h5 class="card-title">Total Complaints</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-lightbulb" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $sugcount;?></h1> 
                                    <h5 class="card-title">Total Suggestions</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-handcuffs" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $blotcount;?></h1> 
                                    <h5 class="card-title">Total Blotters </h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-15">
                                    <h1 class="card-title"><i class="fa-solid fa-file-invoice" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $reqcount;?></h1> 
                                    <h5 class="card-title">Total Document Requests</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <br>
                <?php
                $query1 = "SELECT * FROM resident_table WHERE status ='active';";
                $result1 = $conn -> query($query1);
                $rescount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM tblhousehold WHERE status ='active';";
                $result1 = $conn -> query($query1);
                $hcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM resident_table WHERE gender = 'male' and status ='active';";
                $result1 = $conn -> query($query1);
                $mcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM resident_table WHERE gender = 'female' and status ='active';";
                $result1 = $conn -> query($query1);
                $fcount = mysqli_num_rows($result1);

                $query1 = "SELECT * FROM document_request";
                $result1 = $conn -> query($query1);
                $reqcount = mysqli_num_rows($result1);
                ?>
                <h5 class="card-title">Population Summary</h5>   
                <br>
                <div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-people-group"  style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $rescount;?></h1> 
                                    <h5 class="card-title">Population</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-house-chimney-user" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $hcount;?></h1> 
                                    <h5 class="card-title">Total Household</h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="card-title"><i class="fa-solid fa-person" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $mcount;?></h1> 
                                    <h5 class="card-title">Total Males </h5>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="shadow-sm card mb-3 me-2" style="width: 18rem;display: inline-block; color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-15">
                                    <h1 class="card-title"><i class="fa-solid fa-person-dress" style="color:<?php include("../../phpfiles/bgy_info.php"); echo $row[1];?>"></i>&nbsp;&nbsp;&nbsp;<?php echo $fcount;?></h1> 
                                    <h5 class="card-title">Total Females</h5>
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
                <!--<?php if($availability[2] == 'yes'){ ?>
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
                ?>-->
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
                <?php if($availability[6] == 'yes'){ ?>
                        <div class="card mb-3 me-2" style="width: 18rem;display: inline-block;">
                            <a href="../reports/report.php" class="text-decoration-none text-dark">
                            <img src="../icons/report.jpg" class="card-img-top" style="filter: brightness(50%);">
                            <div class="card-body">
                                <h5 class="card-title">Reports</h5>
                                <p class="card-text">Generate Report on the Barangay System.</p>
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