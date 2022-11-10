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
    <title>Announcements</title>
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
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            <div class="dashboard_content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <h2 class="text fs-5" >Announcements</h2>
                <hr>
                <?php
                    $query = "SELECT * FROM announcement WHERE status = 'active'  ORDER BY id DESC";
                    $result = $conn -> query($query);
                    

                    while($row = $result->fetch_assoc()) {
                ?>
                    
                    <div class="card mb-3 me-2">
                        
                        <div class="row no-gutters">
                            
                            <div class="col-md-2">
                                <img src="../../announcement_uploads/<?php echo $row['img_url'];
                                ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['title'];?></h5>
                                    <p class="card-text"><?php echo $row['descrip'];?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card-body">
                                    <p class="card-text"  style = "font-size: 16px;"><b>Posted on:</b> <br>
                                    <?php 
                                    $orgDate = $row['date'];  
                                    $newDate = date("Y-m-d, h:i:s a", strtotime($orgDate));  
                                    echo $newDate;
                                    ?></p>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="card-body">
                                    <button class="viewA btn btn-primary" data-id="<?php echo $row['id']; ?>" style="float:right;"><i class="fa-solid fa-eye"></i></button>
                                    <br><br>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--View Modal-->
        <div class="modal fade modal-md" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                
                        
                    
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

    <!--view announcement script-->
    <script>
        $(document).ready(function(){
            $('.viewA').click(function(){
                var annID = $(this).data('id');
                $.ajax({url: "view_ann.php",
                method:'post',
                data: {annID:annID},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewModal').modal('show');
            });
        });
    </script>
</body>
</html>