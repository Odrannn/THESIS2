<?php 
if(isset($_POST['userid'])){

    include("../../phpfiles/connection.php");
    $query = "SELECT * FROM tblofficial WHERE official_id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row1 = mysqli_fetch_array($result)?>

    <form action="edit_official.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Official</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" id="position" name="position" required>
                                <option value="">-Select-</option>
                                <option value="Chairman" <?php if($row1["position"] == "Chairman"){ echo "selected"; }?>>Chairman</option>
                                <option value="Kagawad" <?php if($row1["position"] == "Kagawad"){ echo "selected"; }?>>Kagawad</option>
                                <option value="Secretary" <?php if($row1["position"] == "Secretary"){ echo "selected"; }?>>Secretary</option>
                                <option value="Exo" <?php if($row1["position"] == "Exo"){ echo "selected"; }?>>Ex-o</option>
                            </select>
                            <label for="position">Position</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="date" id="term_start" name="term_start" value="<?php echo $row1["term_start"];?>" required>
                            <label for="term_start">Term Start</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="date" id="term_end" name="term_end" value="<?php echo $row1["term_end"];?>"required>
                            <label for="term_start">Term End</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" id="status" name="status" required>
                                <option value="active" <?php if($row1["status"] == "active"){ echo "selected"; }?>>Active</option>
                                <option value="inactive" <?php if($row1["status"] == "inactive"){ echo "selected"; }?>>Inactive</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="official_id" value="<?php echo $row1['official_id'];?>">
            <input type="submit" class="btn btn-success" name="edit_official" value="Update">
        </div>
    </div>
    </form>
    <?php
} ?>

    