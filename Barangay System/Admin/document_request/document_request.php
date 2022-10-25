<?php 
session_start();
include('../../phpfiles/connection.php');

if($_SESSION['user_id'] == '') {
    header("location:../../Login/login.php");
}
?>
<?php
    if (isset($_POST['start'])){
        $start = $conn -> real_escape_string($_POST['start']);

        $allData = '';
        $resultm = $conn -> query("SELECT * FROM document_request LIMIT $start, 50;");
        while($row = $resultm->fetch_assoc()){ 
            $allData .= $row["request_ID"] . ',' . $row["official_ID"] . ',' . $row["resident_ID"] . ',' . $row["document_ID"] . ',' . $row["purpose"] . ',' . $row["quantity"] . ',' . $row["payment"] . ',' . $row["request_date"] . ',' . $row["status"] . ',' ."\n";
        }
        exit(json_encode(array("data" => $allData)));
    }
    $sql = $conn -> query("SELECT suggestion_ID FROM suggestion_table;");
    $numRows = mysqli_num_rows($sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document Requests</title>
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
            <li class=""><a href="../announcement/announcement.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-bullhorn"></i>&nbsp;Announcement</a></li>
            <li class=""><a href="../configuration/configuration.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-gear"></i>&nbsp;Configuration</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include("../../phpfiles/official_nav.php")?>
            
            <div class="dashboard-content px-3 py-4">
                <a href="../dashboard/dashboard.php"><button type="button" class="btn btn-dark">Back</button></a>
                <br>
                <br>
                <h2 class="fs-5">Request Managemet</h2>
                <p>The barangay officials can quickly manage the requested documents in this module.
                    They can check the feature to see how many requests are still pending and how many have already been granted to the residents. </p>
                
                <?php
                    include("../../phpfiles/connection.php");
                    $query1 = "SELECT * FROM document_type;";
                    $result1 = $conn -> query($query1);
                ?>
                <div class="card">
                    <h5 class="card-header">Document List <!--<button class="adddocument btn btn-success" style="float: right">Add</button>--></h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Document ID</th>
                                            <th>Document Type</th>
                                            <th>Price (PHP)</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php while($row1 = $result1->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row1["id"]; ?></td>
                                        <td><?php echo $row1["document_type"]; ?></td>
                                        <td><?php echo $row1["price"]; ?></td>
                                        <td><?php echo $row1["availability"]; ?></td>
                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-id="<?php echo $row1['id']; ?>" class="editdoc btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>    
                </div>
                <?php
                    include("../../phpfiles/connection.php");
                    $query1 = "SELECT * FROM payment_info;";
                    $result1 = $conn -> query($query1);
                    $row1 = $result1->fetch_assoc();
                ?>
                <br>
                <div class="card">
                    <h5 class="card-header">Payment Information<!--<button class="adddocument btn btn-success" style="float: right">Add</button>--></h5>
                    <div class="card-body">
                        <!--alert message-->
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>
                        <?php 
                        if (isset($_SESSION['pinfoMessage'])){
                            if ($_SESSION['pinfoMessage']==1){?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    Payment information successfully updated.
                                </div>
                            </div>
                        <?php 
                            }
                        }
                        $_SESSION['pinfoMessage'] = "";
                        ?>
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <form action="update_payment.php" method="post">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><div class="form-floating">
                                                <input class="form-control" type="text" id="gname" name="gname" value="<?php echo $row1['g_name']?>"required>
                                                <label for="price">G Cash Name</label>
                                            </div></td>
                                            <td><div class="form-floating">
                                                <input class="form-control" type="text" id="gnum" name="gnum" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="<?php echo $row1['cp_number']?>" required>
                                                <label for="price">G Cash Number</label>
                                            </div></td>
                                            <td><div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="submit" class="btn btn-success" name="save_info">Save</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>  
                        </div>
                    </div>    
                </div>
                <br>
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $_GET['page'] = 1;
                        $page = $_GET['page'];
                    }
                    
                    $start = ($page-1) * 10;
                    $query = "SELECT * FROM document_request ORDER BY request_ID DESC LIMIT $start, 10;";
                    $result = $conn -> query($query);

                    $result1 = $conn -> query("SELECT count(request_ID) as id FROM document_request;");
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
                ?>
                <!--alert message-->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>
                <?php 
                if (isset($_SESSION["importRequest"])){
                    if($_SESSION["importRequest"] == "success"){?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                CSV data succesfully imported
                            </div>
                        </div>
                <?php 
                    }else if($_SESSION["importRequest"] == "fail"){?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Problem in importing CSV
                            </div>
                        </div>
                <?php
                    }
                    $_SESSION["importRequest"] = "";
                }
                ?>
                <div class="card">
                    <h5 class="card-header">Request List</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="align-top">
                                            <th>Request ID</th>
                                            <th>Official in Charge</th>
                                            <th>Resident ID</th>
                                            <th>Document ID</th>
                                            <th>Purpose</th>
                                            <th>Quantity</th>
                                            <th>Payment</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php while($row = $result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row["request_ID"]; ?></td>
                                        <td><?php echo $row["official_ID"]; ?></td>
                                        <td><?php echo $row["resident_ID"]; ?></td>
                                        <td><?php echo $row["document_ID"]; ?></td>
                                        <td><?php echo $row["purpose"]; ?></td>
                                        <td><?php echo $row["quantity"]; ?></td>
                                        <td><?php echo $row["payment"]; ?></td>
                                        <td><?php echo $row["request_date"]; ?></td>
                                        <td colspan='2'><div class="btn btn-outline-<?php if($row["status"]=='completed'){echo 'success';}
                                        else if($row["status"]=='pending for verification' || $row["status"]=='pending for payment'){
                                            echo 'primary';
                                        } else {
                                            echo 'danger';
                                        }
                                        ?>"><?php echo $row["status"]; ?></div></td>
                                        <td><?php
                                        if($row["status"]!='cancelled' && $row["status"]!='pending for payment'){
                                        ?>
                                            <button data-id="<?php echo $row['request_ID']; ?>" class="viewreq btn btn-primary"><i class="fa-solid fa-eye"></i></button></td>
                                        <?php }?>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div><br>
                <nav aria-label="Page navigation example">
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <div><a class="import btn btn-outline-success">Import</a></div>
                        <div id="response">Please wait..</div>
                    </div>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="document_request.php?page=<?php echo $previous;?>">Previous</a></li>
                        <?php for($i=1; $i<=$pages;$i++)
                        {?>
                            <li class="page-item"><a class="page-link text-dark" href="document_request.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php 
                        }?>
                        <li class="page-item"><a class="page-link text-dark" href="document_request.php?page=<?php echo $next;?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Add Modal-->
    <div class="modal fade modal-md" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

    <!--View Modal-->
    <div class="modal fade modal-md" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>
    
    <!--Refund Modal-->
    <div class="modal fade modal-md" id="refModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>

    <!--Edit document Modal-->
    <div class="modal fade modal-md" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <!-- Add document script-->
    <script>
        $(document).ready(function(){
            $('.adddocument').click(function(){
                $.ajax({url: "add_form.php",
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#addModal').modal('show');
            });
        });
    </script>
    <!-- View request script-->
    <script>
        $(document).ready(function(){
            $('.viewreq').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "view_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#viewModal').modal('show');
            });
        });
    </script>

    <!-- View request script-->
    <script>
        $(document).ready(function(){
            $('.refund').click(function(){
                var reqid = $(this).data('id');
                $.ajax({url: "refund_form.php",
                method:'post',
                data: {reqid:reqid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#refModal').modal('show');
            });
        });
    </script>

    <!-- edit document script-->
    <script>
        $(document).ready(function(){
            $('.editdoc').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "editdoc_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
    <!--Import Modal-->
    <div class="modal fade modal-md" id="impModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>
    <!-- Import CSV script-->
    <script>
        $(document).ready(function(){
            $('.import').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "import_form.php",
                method:'post',
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#impModal').modal('show');
            });
        });
    </script>
    <!-- Export CSV-->
    <script>
        var data = "data:text/csv;charset=utf-8,";

        $(document).ready(function(){
            exportToCSV(0,<?php echo $numRows ?>);
        });

        function exportToCSV(start, max){
            if (start > max){
                $("#response").html('<a href="'+data+'" download = "Document-Request-Table" class="btn btn-outline-primary">Export</a>');
                return;
            }
            $.ajax({ url: "document_request.php",
            method: 'POST',
            dataType: 'json',
            data: {start: start}, 
            
            success: function (response) {
                data += response.data;
                exportToCSV((start + 50), max);
            }});
        }
    </script>
</body>
</html>