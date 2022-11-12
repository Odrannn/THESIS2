
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <div class="d-flex justify-content-between d-md-none d-block">
        <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
        <a class="navbar-brand fs-4" href="#"><span class=""><img src="../../Admin/configuration/uploads/<?php
                include("../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "50" height ="50" class="img-thumbnail"></span></a>
    </div>
    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
    </button>
    <?php
        //GET RESIDENT ID
        $queryR = "SELECT * FROM resident_table WHERE user_id = '".$_SESSION['user_id']."';";
        $resultR = $conn -> query($queryR);
        $rowR = $resultR->fetch_assoc();
        $residentID = $rowR['id'];

        $query2 = "SELECT * FROM user_notification WHERE resident_ID = '$residentID' ORDER BY notification_ID DESC;";
        $result2 = $conn -> query($query2);
        $count1 = mysqli_num_rows($result2);

        $queryc = "SELECT * FROM user_notification WHERE status = '0' AND resident_ID = '$residentID'";
        $resultc = $conn -> query($queryc);
        $count = mysqli_num_rows($resultc);
    ?>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell px-2"></i><?php if($count != 0){?>
                    <span class="bg-danger rounded-pill text-white badge" style = "position:relative;top:-10px;left:-20px;"><?php echo $count?></span>
                    <?php }?>
                </a>
                <!--Notification List-->
                <ul class="dropdown-menu dropdown-menu-end" style="height: auto; max-height: 600px; overflow-x: hidden;">
                    <?php 
                    if($count1 != 0){
                        while($rownot = $result2->fetch_assoc()){
                            $timestamp = $rownot['date_time'];
                            $dateTime = date("M d, Y, h:i a",strtotime($timestamp));

                            $query1 = "SELECT * FROM resident_table WHERE id = '". $rownot['source_ID']."'";
                            $result1 = $conn -> query($query1);
                            $row1 = $result1->fetch_assoc();
                            if($rownot['status'] == '0'){ 
                                $notifID = $rownot['notification_ID'];?>
                                <li><a class="dropdown-item " href="../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
                                <b><?php echo $rownot['notification_type'];?></b><i class="fa-solid fa-circle text-danger" style="float:right; font-size:12px;"></i><br>
                                <?php echo $rownot['message']; ?><br>
                                <b class="text-primary"><?php echo $dateTime;?></b>
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                        <?php 
                            } else {
                                $notifID = $rownot['notification_ID'];?>
                                <li ><a class="dropdown-item" href="../../phpfiles/readnotifuser.php?notifid=<?php echo $notifID?>">
                                <?php echo $rownot['notification_type'];?><br>
                                <?php echo $rownot['message']; ?><br>
                                <?php echo $dateTime;?>

                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php   
                            }
                        }
                    } else {?>
                        <li ><p class="dropdown-item">No notification right now.</p></li>
                    <?php 
                    }?>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../../user_profile_management/profile.php"><i class="fa-solid fa-user px-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <a href="../../Login/logout.php" class="nav-link" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
</nav>