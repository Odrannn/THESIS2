<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Boxicons CDN Link -->
    <meta name="viewport" content="width=device-width, initial-scale1.0">
</head>
<body>
    <div class="sidebar" style="background: <?php
        $conn = new mysqli("localhost", "root", "", "bgy_system") or die("Unable to connect");
        $query = "SELECT * FROM bgy_info;";
        $result = $conn -> query($query);
        $row = $result -> fetch_array();
        echo $row[1];
    ?>"> 
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-building-house'></i>
                <div class="logo_name">E-Barangay</div>
            </div>
            <i class='bx bx-menu' id="btn_menu"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="#">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../file_received/file_received.html">
                    <i class='bx bx-file' ></i>
                    <span class="links_name">File Received</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../announcement/announcement.html">
                    <i class='bx bx-notification' ></i>
                    <span class="links_name">Announcement</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../configuration/configuration.php">
                    <i class='bx bx-cog' ></i>
                    <span class="links_name">Configuration</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile" style="background: <?php
                echo $row[1];
            ?>">
                <div class="profile_details">
                    <img src="../icons/admin_pic.jpg">
                    <div class="name_type">
                        <div class="name">Bernard Mazo</div>
                        <div class="type">Admin</div>
                    </div>
                </div>
                <a href="../../Login_v10/index.html">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="dashboard_content">
        <div class="text">Dashboard</div>
        <hr>
        <div class="cards">
            <?php include('../configuration/modules_available.php');
                if($availability[0] == 'yes'){ ?>
                    <div class="card">
                        <a href="../case_management/case_management.html">
                        <img src="../icons/complaint2.jpg">
                        <div class="box">
                            <p>Case Management</p>
                        </div>
                        </a>
                </div>
            <?php
                }
            ?>
            <?php include('../configuration/modules_available.php');
                if($availability[1] == 'yes'){ ?>
                    <div class="card">
                        <a href="../resident_management/resident_management.html">
                        <img src="../icons/resident.jpg">
                        <div class="box">
                            <p>Resident Management</p>
                        </div>
                        </a>
                    </div>
            <?php
                }
            ?>
            <?php include('../configuration/modules_available.php');
                if($availability[2] == 'yes'){ ?>
                    <div class="card">
                        <a href="../healthcare_center/healthcare_center.html">
                        <img src="../icons/health.jpg">
                        <div class="box">
                            <p>Healthcare Center</p>
                        </div>
                        </a>
                    </div>
            <?php
                }
            ?>
            <?php include('../configuration/modules_available.php');
                if($availability[3] == 'yes'){ ?>
                    <div class="card">
                        <a href="../document_request/document_request.html">
                        <img src="../icons/request.jpg">
                        <div class="box">
                            <p>Request Verification</p>
                        </div>
                        </a>
                    </div>
            <?php
                }
            ?>
            <?php include('../configuration/modules_available.php');
                if($availability[4] == 'yes'){ ?>
                    <div class="card">
                        <a href="../official_management/official_management.html">
                        <img src="../icons/admin.jpg">
                        <div class="box">
                            <p>Officials Management</p>
                        </div>
                        </a>
                    </div>
            <?php
                }
            ?>
            <?php include('../configuration/modules_available.php');
                if($availability[5] == 'yes'){ ?>
                    <div class="card">
                        <a href="../user_management/user_management.html">
                        <img src="../icons/user.jpg">
                        <div class="box">
                            <p>User Management</p>
                        </div>
                        </a>
                    </div>
            <?php
                }
            ?>
        </div>
        <p class="text" style="text-align: center; font-size: 30px">Welcome to Barangay <?php
                include("../../phpfiles/bgy_info.php");
                echo $row['bgy_name'];
            ?></p>
        <br>
        <p class="text" style="font-size: 30px; text-align: center;">Mission</p>
        <p class="text" style="margin: 0 400px; text-align: center;">"<?php
                include("../../phpfiles/bgy_info.php");
                echo $row['mission'];
            ?>"</p>
        <br>
        <p class="text" style="font-size: 30px; text-align: center;">Vision</p>
        <p class="text" style="margin: 0 400px; text-align: center;">“<?php
                include("../../phpfiles/bgy_info.php");
                echo $row['vision'];?>”</p>
        <br>
    </div>

    <script>
        let btn_menu = document.querySelector("#btn_menu");
        let sidebar = document.querySelector(".sidebar");

        btn_menu.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>