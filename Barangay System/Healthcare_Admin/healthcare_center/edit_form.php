<?php 
include("../../phpfiles/connection.php"); 
$query = "SELECT * FROM healthcare_logs WHERE id = '".$_POST['userid']."';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();
?>

<div class="modal-content">
    <form action="edit_log.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <textarea class="form-control" name="reason" id="reason" row="5" required><?php echo $row['reason'];?></textarea>
                        <label for="reason">Reason For Visit</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="submit" class="btn btn-success" name="edit" value="Update">
    </div>
    </form>
</div>

