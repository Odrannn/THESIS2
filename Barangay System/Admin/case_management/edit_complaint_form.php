<?php 
if(isset($_POST['userid'])){

    include("../../phpfiles/connection.php");
    $query = "SELECT C.*,O.position, O.name FROM complaint_table C INNER JOIN tblofficial O ON C.official_ID = O.official_id WHERE complaint_ID = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>

    <form action="update_complaint.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Complaint</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <p class="m-0"><b>Official in Charge: </b><?php echo $row["position"] . '. '. $row["name"] ?></p>
                    <p class="m-0"><b>Sender: </b>Anonymous</p>
                    <p class="m-0"><b>Nature of Complaint: </b><?php echo $row["complaint_nature"] ?></p>
                    <p class="m-0"><b>Description: </b><?php echo $row["comp_desc"] ?></p>
                    <p class="m-0"><b>Date: </b><?php echo $row["complaint_date"] ?></p>
                    <p class="m-0"><b>Status: </b><?php echo $row["complaint_status"] ?></p>
                    <p class="m-0"><b>Proof:</p>
                    
                </div>
                <div class="row">
                    <img src='../../complaint_uploads/<?php echo $row["img_proof"] ?>' style='width: 100%;'>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="user_id" value="<?php echo $row['complaint_ID']; ?>">
            <input type="submit" class="btn btn-success" name="solve" value="Mark as Solve">
        </div>
    </div>
    </form>
    <?php
} ?>

    