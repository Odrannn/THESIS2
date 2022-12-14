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
    <title>Configuration</title>
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
            <li class=""><a href="../dashboard/dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a></li>
            <?php 
            include('../../phpfiles/modules_available.php');
            if($availability[0] == 'yes'){ ?>
            <li class=""><a href="../case_management/case_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-paper-plane"></i>&nbsp;Case</a></li>
            <?php } 
            if($availability[1] == 'yes'){ ?>
            <li class=""><a href="../resident_management/resident_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-people-group"></i>&nbsp;Resident</a></li>
            <?php } 
            if($availability[3] == 'yes'){ ?>
            <li class=""><a href="../document_request/document_request.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-invoice"></i>&nbsp;Request</a></li>
            <?php } 
            if($availability[4] == 'yes'){ ?>
            <li class=""><a href="../official_management/official_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-image-portrait"></i>&nbsp;Official</a></li>
            <?php } 
            if($availability[5] == 'yes'){ ?>
            <li class=""><a href="../user_management/user_management.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i>&nbsp;User</a></li>
            <?php } 
            if($availability[6] == 'yes'){ ?>
            <li class=""><a href="../reports/report.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-newspaper"></i>&nbsp;Reports</a></li>
            <?php } ?>
            <hr class="text-light">
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class="active"><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/official_nav.php")?>
            <div class="dashboard-content px-3 py-4">
                <h2 class="fs-5">Configuration</h2>
            </div>
            <img src="uploads/<?php
                include("../../phpfiles/bgy_info.php");
                echo $row[2];
            ?>" width = "100" heigh ="100" class="img-thumbnail mx-3">
            <!--<div class="card mt-2 mx-3">
                <h5 class="card-header">Website Database</h5>
                <div class="card-body">
                    <form class="row g-3" action="color_change.php" method="post">
                        <div class="col-auto">
                            <a class="import btn btn-success">Import</a>
                            <a href="export_database.php" class="import btn btn-primary">Export</a>
                        </div>
                    </form>
                </div>
            </div>-->
            
            <?php if(isset($_SESSION['message']) && $_SESSION['message'] !=''){
                    if($_SESSION['status'] == 1){?>
                        <div class="alert alert-success mt-2 mx-3" role="alert">
                            <h4 class="alert-heading">Successful!</h4>
                            <p class="mb-0"><?php echo $_SESSION['message']?></p>
                        </div>
                <?php
                    } else {?>
                        <div class="alert alert-danger mt-2 mx-3" role="alert">
                            <h4 class="alert-heading">Failed!</h4>
                            <p class="mb-0"><?php echo $_SESSION['message']?></p>
                        </div>
                <?php
                    }
                    $_SESSION['message'] = '';
                }
                ?>
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
                        <div class="row mt-2">
                            <div class="col-auto">
                                <h5 class="card-title">Barangay Telephone Number</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" placeholder="Telephone number..." maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" name= "tp_number" value="<?php echo $row[8]?>">
                            </div><br>
                        </div>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <h5 class="card-title">Barangay Email</h5>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" placeholder="Email" name= "bgy_email" value="<?php echo $row[9]?>">
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
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Reports" <?php
                                    if($availability[6] == 'yes'){
                                        echo 'checked';
                                    }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Reports</h5>
                            </div>
                        </div>
						<div class="row mt-2">
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="modules[]" value="Logs" <?php
                                    if($availability[7] == 'yes'){
                                        echo 'checked';
                                    }?>>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h5 class="card-title">Logs</h5>
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