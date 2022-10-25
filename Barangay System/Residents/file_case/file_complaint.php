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
    <title>File Complaint</title>
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
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between"><span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
			<li class=""><a href="../request_document/request_document.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            </ul>
        </div>
        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <div>
                    <div class="d-flex justify-content-center">
                        <div class="btn-group">
                            <a class="btn btn-outline-dark active">Complaints</an>
                            <a href="send_suggestion/send_suggestion.php" class="btn btn-outline-dark">Suggestion</a>
                            <a href="file_blotter/file_blotter.php" class="btn btn-outline-dark">Blotter</a>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="text fs-5">File Complaint</h2>
                <p>In this module, locals can complain to the barangay and voice their concerns. Users might also choose to submit a specific issue under the jurisdiction of their barangay.</p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="file_complaint.php">Create Complaint</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_complaints.php">View Complaints</a>
                    </li>
                </ul>
                <br>
                <div class="card mt-2">
                    <h5 class="card-header">Complaint Form</h5>
                    <div class="cardContainer card-body">
                        <?php 
                        if(isset($_SESSION['complaint_message']))
                        {
                            if($_SESSION['complaint_message'] != ''){?>
                            <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Thank you!</h4>
                            <p><?php echo $_SESSION['complaint_message'];?></p>
                            </div> 
                        <?php }
                            $_SESSION['complaint_message'] = '';
                        } ?>
                        <form class="g-3" action="send_case.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="nature">Nature of Complaint</label>
                                    <select class="form-control" id="nature" name="nature">
                                        <?php include("../../phpfiles/case_option.php"); 
                                        while($row = $result->fetch_assoc()){?>
                                        <option value="<?php echo $row['complaint_nature']; ?>"><?php echo $row['complaint_nature']; ?></option>
                                        <?php } ?>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="otherInput">
                                </div>
                                <div class="col-md pt-2">
                                    <label class="pb-2" for="comp_image">Proof of Complaint</label> 
                                    <input class="form-control" type="file" id="comp_image" name="comp_image"></td>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col pt-2">
                                <label class="pb-2" for="comp_image">Description</label> 
                                    <textarea class="form-control" id= "description" name= "description" rows="10"></textarea>
                                </div>  
                            </div>
                        
                            <div class="row mt-4 d-flex flex-row-reverse">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3" name="send_complaint" value="Send">Send</button>
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

    <!--Filter-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#nature").on('change',function(){
                var value = $(this).val();

                $.ajax({
                    url: "nature.php",
                    method: "POST",
                    data: {nature:value},

                    success:function(data){
                        $(".otherInput").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>