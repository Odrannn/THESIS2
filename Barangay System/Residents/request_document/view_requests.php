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
    <title>Request Document</title>
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
            <?php 
            include('../../phpfiles/modules_available.php');
            if($availability[0] == 'yes'){ ?>
            <li class=""><a href="../file_case/file_complaint.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid fa-headset"></i>&nbsp;Complain</span>
            <li class=""><a href="../file_case/send_suggestion/send_suggestion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Suggest</a></li>
            <li class=""><a href="../file_case/file_blotter/file_blotter.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-stamp"></i>&nbsp;Blotter</a></li>
            <?php } ?>
			<li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file"></i>&nbsp;Request Document</a></li>
            <li class=""><a href="../announcements/announcements.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-sharp fa-solid fa-radio"></i>&nbsp;Announcements</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/user_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="request_document.php">Create Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">View Requests</a>
                    </li>
                </ul>
                <br>
                <h2 class="text fs-5">Request Tracker</h2>
                <p>This modules shows your request history and its status.</p>

                <div class="card">
                    <h5 class="card-header">Request List</h5>
                    <div class="card-body">
                        <?php 
                        if(isset($_SESSION['cancelReq']))
                        {
                            if($_SESSION['cancelReq'] != ''){?>
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Request Cancelled!</h4>
                                    <p><?php echo $_SESSION['cancelReq'];?></p>
                                </div> 
                                <?php } 
                            $_SESSION['cancelReq'] = '';
                        } ?>
                        <?php 
                        if(isset($_SESSION['paymentMessage']))
                        {
                            if($_SESSION['paymentMessage'] != ''){?>
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Payment Sent!</h4>
                                    <p><?php echo $_SESSION['paymentMessage'];?></p>
                                </div> 
                                <?php } 
                            $_SESSION['paymentMessage'] = '';
                        } ?>
                        <div class="container-fluid">
                            
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Request ID</th>
                                            <th>Document Type</th>
                                            <th>Purpose</th>
                                            <th style ="text-align:center;">Quantity</th>
                                            <th>Date</th>
                                            <th style ="text-align:center;" colspan='2'>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $userid = $_SESSION['user_id'];
                                    //get resident id
                                    $query = "SELECT id FROM resident_table WHERE user_id = '$userid'";
                                    $result = $conn -> query($query);
                                    $row = $result->fetch_array();
                                    $residentID = $row['id'];

                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    } else {
                                        $_GET['page'] = 1;
                                        $page = $_GET['page'];
                                    }
                                    
                                    $start = ($page-1) * 10;
                                    //select all request
                                    $query = "SELECT R.*, D.document_type FROM document_request R INNER JOIN document_type D ON R.document_ID = D.id
                                    WHERE resident_ID = '$residentID'  ORDER BY request_ID DESC LIMIT $start, 10;";
                                    $result = $conn -> query($query);
                
                                    $result1 = $conn -> query("SELECT count(request_ID) as id FROM document_request WHERE resident_ID = '$residentID'");
                                    $reqCount = $result1->fetch_assoc();
                                    $total = $reqCount['id'];
                                    $pages = ceil($total / 10);
                                    
                                    if($page > 1){
                                        $previous = $page - 1;
                                    } else {
                                        $previous = $page;
                                    }
                
                                    if($page < $pages){
                                        $next = $page + 1;
                                    } else {
                                        $next = $page;
                                    }
                                    while($row1 = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row1["request_ID"]; ?></td>
                                        <td><?php echo $row1["document_type"]; ?></td>
                                        <td><?php echo $row1["purpose"]; ?></td>
                                        <td style ="text-align:center;"><?php echo $row1["quantity"]; ?></td>
                                        <td><?php echo $row1["request_date"]; ?></td>
                                        <td style ="text-align:center;" colspan='2'><div style ="width: 200px;" class="btn btn-outline-<?php if($row1["status"]=='completed'){echo 'success';}
                                        else if($row1["status"]=='pending for verification' || $row1["status"]=='pending for payment'){
                                            echo 'primary';
                                        } else {
                                            echo 'danger';
                                        }
                                        ?>"><?php echo $row1["status"]; ?></div></td>
                                        <td>
                                        <?php if($row1["status"]=='completed'){?>
                                            <form action="../../generate-document/generate_document.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row1['request_ID'];?>">
                                                <input type="hidden" name="senderid" value="<?php echo $row1['resident_ID'];?>">
                                                <input type="hidden" name="documentid" value="<?php echo $row1['document_ID'];?>">
                                                <input type="hidden" name="officialid" value="<?php echo $row1['official_ID'];?>">
                                                <input type="submit" style ="width: 185px;" class="btn btn-success" name="download" value="Download soft copy">
                                            </form>   
                                        <?php } else if($row1["status"]=='pending for payment') {?> 
                                            <button data-id="<?php echo $row1['request_ID']; ?>" class="pay btn btn-primary">Pay</button>
                                            <button data-id="<?php echo $row1['request_ID']; ?>" class="cancelreq btn btn-danger">Cancel request</button>
                                        <?php } else if($row1["status"]=='pending for verification') {?>  
                                            <button data-id="<?php echo $row1['request_ID']; ?>" style ="width: 185px;" class="viewpay btn btn-primary">View payment</button>
                                        <?php }?>  
                                        </td>
                                    </tr>
                                    
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="view_requests.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="view_requests.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="view_requests.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
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

    <!--cancel Modal-->
    <div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

    <!--pay Modal-->
    <div class="modal fade" id="payModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

     <!--view pay Modal-->
     <div class="modal fade" id="viewpayModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

    <!-- cancel script-->
    <script>
        $(document).ready(function(){
            $('.cancelreq').click(function(){
                var reqid = $(this).data('id');
                $.ajax({url: "cancel_request_form.php",
                method:'post',
                data: {reqid:reqid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#cancelModal').modal('show');
            });
        });
    </script>

    <!-- payscript-->
    <script>
        $(document).ready(function(){
            $('.pay').click(function(){
                var reqid = $(this).data('id');
                $.ajax({url: "payment_form.php",
                method:'post',
                data: {reqid:reqid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#payModal').modal('show');
            });
        });
    </script>

     <!-- payscript-->
     <script>
        $(document).ready(function(){
            $('.viewpay').click(function(){
                var reqid = $(this).data('id');
                $.ajax({url: "view_payment.php",
                method:'post',
                data: {reqid:reqid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewpayModal').modal('show');
            });
        });
    </script>
</body>
</html>