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
        $query2 = "SELECT * FROM admin_notification";
        $result2 = $conn -> query($query2);
        $count = mysqli_num_rows($result2);
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
                        <?php while($rownot = $result2->fetch_assoc()){
                            $timestamp = $rownot['date_time'];
                            $dateTime = date("M d, Y, g:i a",strtotime($timestamp));

                            $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                            $result1 = $conn -> query($query1);
                            $row1 = $result1->fetch_assoc();
                            $name = $row1['fname'] . " " . $row1['lname'];
                            if($rownot['status'] == '0'){ 
                                $_SESSION['typeID'] = $rownot['type_ID'];?>

                                <li><a class="dropdown-item " href="../../phpfiles/readnotif.php">
                                <b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle" style="float:right; font-size:12px; color:<?php
                                                                                                                                                        include("../../phpfiles/bgy_info.php");
                                                                                                                                                        echo $row[1];
                                                                                                                                                        ?>;"></i><br>
                                <?php echo $name . " " . $rownot['message']; ?><br>
                                <b class="text-primary"><?php echo $dateTime;?></b>
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                        <?php 
                            } else {
                                $_SESSION['typeID'] = $rownot['type_ID'];?>
                                <li><a class="dropdown-item" href="../../phpfiles/readnotif.php">
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
                    <a href="../../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>