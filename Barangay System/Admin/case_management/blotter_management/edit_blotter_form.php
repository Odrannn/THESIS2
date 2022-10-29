<?php 
session_start();

if(isset($_POST['blotterid'])){

    include("../../../phpfiles/connection.php");
    $query1 = "SELECT * FROM blotter_table WHERE blotter_ID = '".$_POST['blotterid']."'";
    $result1 = $conn -> query($query1); 
    $row1 = mysqli_fetch_array($result1);
    $off_id = $row1['official_ID'];
    
    $query2 = "SELECT * FROM tblofficial WHERE official_id = '$off_id'";
    $result2 = $conn -> query($query2); 
    $row2 = mysqli_fetch_array($result2);?>

    <form action="update_blotter.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Blotter</h5>
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
                    <p class="m-0"><b>Complainant ID: </b><?php echo $row1["complainant_ID"] ?></p>
                    <p class="m-0"><b>Complainee name: </b><?php echo $row1["complainee_name"] ?></p>
                    <p class="m-0"><b>Accusation: </b><?php echo $row1["blotter_accusation"] ?></p>
                    <p class="m-0"><b>Details: </b><?php echo $row1["blotter_details"] ?></p>
                    <p class="m-0"><b>Date: </b><?php echo $row1["blotter_date"] ?></p>
                    <p class="m-0"><b>Time: </b><?php echo $row1["blotter_time"] ?></p>
                    <p class="m-0"><b>Settlement Date: </b><?php echo $row1["settlement_schedule"] ?></p>
                    <p class="m-0"><b>Status: </b><?php echo $row1["status"] ?></p>
                    <p class="m-0"><b>Result:</p>
                    
                </div>
                <div class="row row m-0 mt-2">
                    <textarea class="form-control" id= "result" name= "result" rows="10" required><?php echo $row1["result_of_settlement"]; ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="blotter_id" value="<?php echo $row1['blotter_ID']; ?>">
            <?php
                if ($off_id != "" && $row1["status"] != 'scheduled'){
                if ($row1['status'] == 'settled'){?>
                    <input type="submit" class="btn btn-primary" name="reset" value="Reset" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-success" name="settled" value="Set As Settled" disabled>
                    <input type="submit" class="btn btn-warning" name="unsettled" value="Set As Unsettled" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                <?php } else if ($row1['status'] == 'unsettled'){ ?>
                    <input type="submit" class="btn btn-primary" name="reset" value="Reset" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-success" name="settled" value="Set As Settled" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-warning" name="unsettled" value="Set As Unsettled" disabled>
                <?php } else { ?>
                    <input type="submit" class="btn btn-primary" name="reset" value="Reset" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-success" name="settled" value="Set As Settled" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-warning" name="unsettled" value="Set As Unsettled" <?php if($row2['user_id'] != $_SESSION['user_id'])
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <?php }
                } else {?>

                    <input type="submit" class="btn btn-success" name="settled" value="Set As Settled" <?php if($row1['status'] == 'unscheduled')
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                    <input type="submit" class="btn btn-warning" name="unsettled" value="Set As Unsettled" <?php if($row1['status'] == 'unscheduled')
                                                                                                    {
                                                                                                       echo "disabled"; 
                                                                                                    } ?>>
                <?php
                }
            ?>
        </div>
    </div>
    </form>
    <?php
} ?>

    