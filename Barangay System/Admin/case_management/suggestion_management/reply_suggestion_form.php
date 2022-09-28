<?php 
session_start();

if(isset($_POST['userid'])){

    include("../../../phpfiles/connection.php");
    //get official in charge and sender id
    $query1 = "SELECT * FROM suggestion_table WHERE suggestion_ID = '".$_POST['userid']."'";
    $result1 = $conn -> query($query1); 
    $row1 = mysqli_fetch_array($result1);
    $off_id = $row1['official_ID'];
    $sen_id = $row1['sender_ID'];
    
    //get official info
    $query2 = "SELECT * FROM tblofficial WHERE official_id = '$off_id'";
    $result2 = $conn -> query($query2); 
    $row2 = mysqli_fetch_array($result2);
    
    //get sender info
    $query3 = "SELECT * FROM resident_table WHERE id = '$sen_id'";
    $result3 = $conn -> query($query3); 
    $row3 = mysqli_fetch_array($result3);?>?>

    

    <form action="reply_suggestion.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Complaint</h5>
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
                    <p class="m-0"><b>Sender: </b><?php echo $row3["fname"] . ' '. $row3["mname"] . ' '. $row3["lname"]; ?></p>
                    <p class="m-0"><b>Nature of Complaint: </b><?php echo $row1["suggestion_nature"]?></p>
                    <p class="m-0"><b>Description: </b><?php echo $row1["suggestion_desc"] ?></p>
                    <p class="m-0"><b>Date: </b><?php echo $row1["suggestion_date"] ?></p>
                    <p class="m-0"><b>Status: </b><?php echo $row1["suggestion_status"] ?></p>
                    <p class="m-0"><b>Create Feedback:</p>
                </div>
                <div class="row m-0 mt-2">
                    <textarea class="form-control" id= "feedback" name= "feedback" rows="10"><?php echo $row1["suggestion_feedback"]; ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="user_id" value="<?php echo $row1['suggestion_ID']; ?>">
            <input type="submit" class="btn btn-success" name="update" value="Update" <?php if($row1['suggestion_status'] == 'noticed'){
                                                                                                if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } 
                                                                                                }?>>
        </div>
    </div>
    </form>
    <?php
} ?>

    