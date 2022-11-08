<?php 
if(isset($_POST['annID'])){

    include("../../phpfiles/connection.php");
    $query = "SELECT * FROM announcement WHERE id = '".$_POST['annID']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>

    
    <div class="modal-content">
        <form action="edit_ann.php" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style = "height: 50%;overflow-y: auto;">
                <div class="container">
                    <div class="row">
                        <div class="col-md pt-2">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="title" name="title" oninput="this.value = this.value.replace(/[^a-z0-9 ]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $row["title"];?>" required>
                                <label for="title">Title</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md pt-2">
                            <div class="form-floating">
                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="10" required><?php echo $row["descrip"];?></textarea>
                                <label for="desc">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md pt-2">
                            <div class="form-floating">
                                <select class="form-control" name="status" id="status">
                                    <option value="active" <?php if($row["status"] == "active"){ echo "selected"; }?>>active</option>
                                    <option value="inactive" <?php if($row["status"] == "inactive"){ echo "selected"; }?>>inactive</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="ann_id" value="<?php echo $row['id'];?>">
                <input type="submit" class="btn btn-success" name="edit_ann" value="Update">
            </div>
        </form>
    </div>
    <?php
} ?>

    