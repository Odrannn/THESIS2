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
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/official_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <h2 class="text fs-5">Announcement</h2>
                <br>
                <div class="card mt-2">
                    <h5 class="card-header">Create Announcemet</h5>
                    <div class="card-body">
                        <form class="g-3" action="post_announcement.php" method="post" enctype="multipart/form-data">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                    <td class="align-middle"><h5>Topic/Title</h5></td>
                                    <td class="w-75 align-middle"><input class="form-control w-50" type="text" placeholder="topic/title..." name= "title"></td>
                                    </tr>
                                    <tr>
                                    <td class="align-middle"><h5>Image</h5></td>
                                    <td class="w-75 align-middle"><input class="form-control w-50" type="file" name="ann_image"></td>
                                    </tr>
                                    <tr>
                                    <td colspan="1"><h5 class="card-title">Description</h5></td>
                                    </tr>
                                </tbody>
                            </table>
                            <textarea class="form-control" name= "description" rows="10"></textarea>
                            <div class="row mt-4 d-flex flex-row-reverse">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3" name="post" value="Post">Post</button>
                                </div>  
                            </div>
                        </form>
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
</body>
</html>