<?php 
if(isset($_POST['userid'])){

    include("../../phpfiles/connection.php");
    $query = "SELECT * FROM tbluser WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row1 = mysqli_fetch_array($result)?>

    <form action="edit_user.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit User Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="username" name="username" onkeyup="lettersnumbersOnly(this)" value="<?php echo $row1["username"];?>">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="password" id="password" name="password" value="<?php echo $row1["password"];?>">
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="type" id="type">
                                <option value="admin" <?php if($row1["type"] == "admin"){ echo "selected"; }?>>Admin</option>
                                <option value="admin0" <?php if($row1["type"] == "admin0"){ echo "selected"; } else { echo "disabled"; }?>>Highest Admin</option>
                                <option value="hadmin" <?php if($row1["type"] == "hadmin"){ echo "selected"; }?>>Healthcare Admin</option>
                                <option value="user" <?php if($row1["type"] == "user"){ echo "selected"; }?>>User</option>
                            </select>
                            <label for="type">User type</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="status" id="status">
                                <option value="active" <?php if($row1["status"] == "active"){ echo "selected"; }?>>active</option>
                                <option value="inactive" <?php if($row1["status"] == "inactive"){ echo "selected"; }?>>inactive</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="user_id" value="<?php echo $row1['id'];?>">
            <input type="submit" class="btn btn-success" name="edit_user" value="Update">
        </div>
    </div>
    </form>
    <?php
} ?>

<script type="text/javascript">
    function lettersnumbersOnly(input){
        var regex = /[^a-z0-9]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>

    