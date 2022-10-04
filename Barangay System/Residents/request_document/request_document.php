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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
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
                                <a href="../../Login/logout.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                
                <h2 class="text fs-5">Request Document</h2>
                <p>In this module, the residents of a barangay can easily request documents from the barangay.</p>
                <div class="card mt-2">
                    <h5 class="card-header">Request Form</h5>
                    <div class="card-body">
                        <?php 
                        if(isset($_SESSION['request_message']))
                        {
                            if($_SESSION['request_message'] != ''){
                                if($_SESSION['error_type'] == 'success'){?>
                                
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">Thank you!</h4>
                                        <p><?php echo $_SESSION['request_message'];?></p>
                                    </div> 
                                <?php } else {?>
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="alert-heading">Error!</h4>
                                        <p><?php echo $_SESSION['request_message'];?></p>
                                    </div> 
                                <?php
                                }
                            }
                            $_SESSION['request_message'] = '';
                            $_SESSION['error_type'] = 'success';
                        } ?>
                        <table class="table">
                            <thead class="table-success">
                                <tr>
                                <th scope="col">Document Type</th>
                                <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = "SELECT * FROM document_type;";
                                $result = $conn -> query($query);
                                while($row = $result->fetch_assoc()){?>
                                <tr>
                                <th scope="row"><?php echo $row['document_type']; ?></th>
                                <td><?php echo $row['price']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <form class="g-3" action="submit_request.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="doc_type">Type of Document</label>
                                    <select class="form-control" id="doc_type" name="doc_type">
                                        <?php 
                                        $query = "SELECT * FROM document_type;";
                                        $result = $conn -> query($query);
                                        while($row = $result->fetch_assoc()){?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['document_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="quantity">Quantity</label> 
                                    <input class="form-control" type="number" id="quantity" name="quantity" required></td>
                                </div>
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="proof">Proof of Payment</label> 
                                    <input class="form-control" type="file" id="proof" name="proof" required></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pt-2">
                                <label class="pb-2" for="purpose">Purpose of Request</label> 
                                    <textarea class="form-control" id= "purpose" name= "purpose" rows="10" required></textarea>
                                </div>  
                            </div>
                        
                            <div class="row mt-4 d-flex flex-row-reverse">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3" name="submit_request" value="Submit">Submit</button>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--Add Modal-->
    <div class="modal fade modal-lg" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            
        </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
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
    <!-- Add resident script-->
    <script>
        $(document).ready(function(){
            $('.addresident').click(function(){
                $.ajax({url: "add_form.php",
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#addModal').modal('show');
            });
        });
    </script>
    <!-- Edit resident script-->
    <script>
        $(document).ready(function(){
            $('.editofficial').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "edit_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
</body>
</html>