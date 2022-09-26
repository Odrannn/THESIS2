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
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-file-lines"></i>&nbsp;File Received</span>
                <span class="bg-dark rounded-pill text-white py-0 px-2">02</span></a></li>
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
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
                                <a class="nav-link active" aria-current="page" href="../../Login/logout.php"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="dashboard-content px-3 py-4">
                <h2 class="fs-5">Configuration</h2>
            </div>
            <img src="uploads/<?php
                include("../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "100" heigh ="100" class="img-thumbnail mx-3">
            <div class="card mt-2 mx-3">
                <h5 class="card-header">Theme Color</h5>
                <div class="card-body">
                    <form class="row g-3" action="color_change.php" method="post">
                        <div class="col-auto">
                            <h5 class="card-title">Primary Color</h5>
                        </div>
                        <div class="col-auto">
                            <input type="color" class="form-control form-control-color" name="prime" value="<?php
                            include("../../phpfiles/bgy_info.php");
                            echo $row[1];
                            ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3" name="save" value="Save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2 mx-3">
                <h5 class="card-header">Logo</h5>
                <div class="card-body">
                    <form class="row g-3" action="change_logo.php" method="post" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col-auto">
                                <h5 class="card-title">Barangay logo</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="file" name="logo">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <h5 class="card-title">Login Background</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="file" name="background">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3" name="upload" value="Upload">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2 mx-3">
                <h5 class="card-header">Barangay Information</h5>
                <div class="card-body">
                    <form class="g-3" action="update_bgy_info.php" method="post">
                        <div class="row">
                            <div class="col-auto">
                                <h5 class="card-title">Barangay name/number</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" placeholder="barangay name/number" name= "bgy_name" value="<?php
                                    include("../../phpfiles/bgy_info.php");
                                    echo $row[3]?>">
                            </div><br>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <h5 class="card-title">City/Municipality</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" placeholder="city/municipality" name= "city" value="<?php
                                    include("../../phpfiles/bgy_info.php");
                                    echo $row[6]?>">
                            </div><br>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <h5 class="card-title">Mission</h5>
                            </div>
                            <div class="col-xl">
                                    <textarea class="form-control" name= "mission" row="5"><?php
                                        include("../../phpfiles/bgy_info.php");
                                        echo $row[5]?></textarea>
                            </div><br>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <h5 class="card-title">Vision</h5>
                            </div>
                            <div class="col-xl">
                                    <textarea class="form-control" name= "vision" row="5"><?php
                                        include("../../phpfiles/bgy_info.php");
                                        echo $row[4]?></textarea>
                            </div><br>
                        </div>
                        
                        <div class="row mt-4 d-flex flex-row-reverse">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3" name="BI_save" value="Save">Save</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2 mx-3">
                <h5 class="card-header">Modules</h5>
                <div class="card-body">
                    <form action="save_module.php" method="POST">
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Case Management" <?php
                                        include('../../phpfiles/modules_available.php');
                                        if($availability[0] == 'yes'){
                                            echo 'checked';
                                        }?>></div>  
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Case Management</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Resident Management" <?php
                                        if($availability[1] == 'yes'){
                                            echo 'checked';
                                        }?>></div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Resident Management</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Healthcare Center" <?php
                                    if($availability[2] == 'yes'){
                                        echo 'checked';
                                        }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Healthcare Center</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Request Verification" <?php
                                    if($availability[3] == 'yes'){
                                        echo 'checked';
                                    }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Request Verification</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Official Management" <?php
                                    if($availability[4] == 'yes'){
                                        echo 'checked';
                                    }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Official Management</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="User Management" <?php
                                    if($availability[5] == 'yes'){
                                        echo 'checked';
                                    }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">User Management</h5>
                            </div>
                        </div>
                        <div class="row mt-4 d-flex flex-row-reverse">
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary mb-3" name="save_module" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2 mx-3">
                <h5 class="card-header">Address Fields</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md pt-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td><h5>Puroks</h5></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table>
                                        <?php
                                            include('address_field_list.php');
                                            while($row = $result -> fetch_array()){

                                            if($row["purok"] != ''){ ?>

                                            <form action="delete_field_list.php" method="post">
                                                <tr>
                                                <td><?php echo $row["purok"]; ?></td>
                                                <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                <td><input class="btn btn-danger mx-3" type='submit' name='delete_purok' value='Delete'></td>
                                                </tr>
                                            </form>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md pt-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td><h5>Sitios</h5></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                            <table>
                                            <?php
                                                include('address_field_list.php');
                                                while($row = $result -> fetch_array()){

                                                if($row["sitio"] != ''){ ?>
                                                    <form action="delete_field_list.php" method="post">
                                                        <tr>
                                                        <td><?php echo $row["sitio"]; ?></td>
                                                        <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                        <td><input class="btn btn-danger mx-3" type='submit' name='delete_sitio' value='Delete'></td>
                                                        </tr>
                                                    </form>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md pt-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td><h5>Streets</h5></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table>
                                        <?php
                                            include('address_field_list.php');

                                            while($row = $result -> fetch_array()){

                                            if($row["street"] != ''){ ?>
                                                <form action="delete_field_list.php" method="post">
                                                    <tr>
                                                    <td><?php echo $row["street"]; ?></td>
                                                    <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                    <td><input class="btn btn-danger mx-3" type='submit' name='delete_street' value='Delete'></td>
                                                    </tr>
                                                </form>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md pt-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td><h5>Subdivisions</h5></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table>
                                        <?php
                                            include('address_field_list.php');
                                            while($row = $result -> fetch_array()){

                                            if($row["subdivision"] != ''){ ?>
                                                <form action="delete_field_list.php" method="post">
                                                    <tr>
                                                    <td><?php echo $row["subdivision"]; ?></td>
                                                    <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                    <td><input class="btn btn-danger mx-3" type='submit' name='delete_subdivision' value='Delete'></td>
                                                    </tr>
                                                </form>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md pt-2">
                            <form action="add_field_list.php" method="post">
                                <td><input class="form-control" type="text" name= "purok" placeholder="enter purok name...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_purok" value="Add">
                                </div></td>
                            </form>
                        </div>
                        <div class="col-md pt-2">
                            <form action="add_field_list.php" method="post">
                                <td><input class="form-control input-sm" type="text" name= "sitio" placeholder="enter sitio name...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_sitio" value="Add">
                                </div></td>
                            </form>
                        </div>
                        <div class="col-md pt-2">
                            <form action="add_field_list.php" method="post">
                                <td><input class="form-control input-sm" type="text" name= "street" placeholder="enter street name...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_street" value="Add">
                                </div></td>
                            </form>
                        </div>
                        <div class="col-md pt-2">
                            <form action="add_field_list.php" method="post">
                                <td><input class="form-control input-sm" type="text" name= "subdivision" placeholder="enter subdivision name...">
                                <div class="d-flex flex-row-reverse">
                                    <input class="mt-2 btn btn-success" type="submit" name="add_subdivision" value="Add">
                                </div></td>
                            </form>
                        </div>
                    </div>
                    
                    
                    <?php
                        $empty_records = array();

                        include('address_field_list.php');
                        while($row = $result -> fetch_array()){
                            if($row['purok'] == '' && $row['sitio'] == '' && $row['street'] == '' && $row['subdivision'] == ''){
                                array_push($empty_records,$row['id']);
                            }
                        }

                        foreach($empty_records as $emp_rec){
                            $query = "DELETE FROM address_fields WHERE id = $emp_rec;";
                            $result = $conn -> query($query);
                        }
                    ?>
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