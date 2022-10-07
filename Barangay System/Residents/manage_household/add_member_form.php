<?php 
session_start();
$userid = $_SESSION['user_id'];
                    
include("../../phpfiles/connection.php"); 
//get resident ID of user
$query = "SELECT id FROM resident_table WHERE user_id = '$userid';";
$result = $conn -> query($query);
$row1 = $result->fetch_assoc();
$resID = $row1['id'];

$query = "SELECT * FROM tblhousehold WHERE household_head_ID = '$resID';";
$result = $conn -> query($query);
$row2 = $result->fetch_assoc();

$query = "SELECT id, concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table WHERE id NOT IN (
    SELECT household_head_ID FROM tblhousehold WHERE status ='active') AND household_ID IS NULL
    ORDER BY Fullname ASC;";
$result = $conn -> query($query);
?>

<div class="modal-content">
    <form action="add_member.php" autocomplete="off" method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md pt-2">
                        <div>
                            <label for="id" class="p-1">Resident ID(Search the name of the resident.)</label>
                            <input class="form-control" type="text" id="id" name="id" list="reslist" placeholder="Enter the resident ID..." required>
                            <datalist id="reslist">
                                <?php while($row = $result -> fetch_array()) { ?>
                                    <option value="<?php echo $row['id']?>"><?php echo $row['Fullname']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" class="btn btn-success" name="householdID" value="<?php echo $row2['household_id']?>">
            <input type="submit" class="btn btn-success" name="add" value="Add">
        </div>
    </form>
</div>
