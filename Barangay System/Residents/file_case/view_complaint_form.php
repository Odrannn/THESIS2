<?php 
session_start();

if(isset($_POST['userid'])){

    include("../../phpfiles/connection.php");
    $query1 = "SELECT * FROM complaint_table WHERE complaint_ID = '".$_POST['userid']."'";
    $result1 = $conn -> query($query1); 
    $row1 = mysqli_fetch_array($result1);
    $off_id = $row1['official_ID'];
    
    $query2 = "SELECT * FROM tblofficial WHERE official_id = '$off_id'";
    $result2 = $conn -> query($query2); 
    $row2 = mysqli_fetch_array($result2);?>

    <form action="update_complaint.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complaint Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <p class="m-0"><b>Official in Charge: </b>
                    <?php 
                    if($off_id != ''){
                        echo $row2["position"] . '. '. $row2["name"];
                    } else {
                        echo 'none';
                    }
                    ?></p>
                    <p class="m-0"><b>Nature of Complaint: </b><?php echo $row1["complaint_nature"] ?></p>
                    <p class="m-0"><b>Description: </b><?php echo $row1["comp_desc"] ?></p>
                    <p class="m-0"><b>Date: </b><?php echo $row1["complaint_date"] ?></p>
                    <p class="m-0"><b>Status: </b><?php echo $row1["complaint_status"] ?></p>
                    <p class="m-0"><b>Proof:</p>
                    
                </div>
                <div class="row">
                    <img src='../../complaint_uploads/<?php echo $row1["img_proof"] ?>' style='width: 100%;' alt="NO PROOF">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </form>
    <?php
} ?>

    