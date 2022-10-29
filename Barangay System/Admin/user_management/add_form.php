<?php 
include("../../phpfiles/connection.php"); 
session_start();
$query = "SELECT id, contactnumber, concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table WHERE user_id is NULL
            ORDER BY Fullname ASC;";
$result = $conn -> query($query);
?>
<style>
.form-message{
    text-align: center;
    color: #162A83;
    padding: 10px 0;
    text-transform: capitalize;
    background: rgba(231, 235, 249, 1);
    font-size: 12px;
    display: none;
}

.form-message p {
    margin: 0;
}

.form-message p span{
    color: #980e
}
</style>
<form autocomplete="off" id="myForm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md pt-2">
                        <div>
                            <label for="id">Resident ID (Search the name of the resident.)</label>
                            <input class="form-control" type="text" id="id" name="id" list="reslist" placeholder="Enter the resident ID..." required>
                            <datalist id="reslist">
                                <?php while($row = $result -> fetch_array()) { ?>
                                    <option value="<?php echo $row['id']?>"><?php echo $row['Fullname']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="uname" name="uname" placeholder="Enter username..." required>
                            <label for="id">Username</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="type" id="type">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="hadmin">Healthcare Admin</option>
                                <option value="admin0" <?php
                                $query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
                                $result1 = $conn -> query($query1);
                                $row1 = $result1 -> fetch_array();
                                
                                if($row1['type'] != 'admin0'){echo 'disabled';}
                                ?>>Highest Admin</option>
                            </select>
                            <label for="type">User type</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-message"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="add_user" value="Add">
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myForm").on('submit',function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "add_user.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success:function(response){
                    $(".form-message").css("display", "block");

                    if(response.status == 1){
                        $("#myForm")[0].reset();
                        $(".form-message").html('<p>' + response.message + '</p>')
                    } else {
                        $(".form-message").html('<p>' + response.message + '</p>')
                    }
                }
            });
        });
    });
</script>