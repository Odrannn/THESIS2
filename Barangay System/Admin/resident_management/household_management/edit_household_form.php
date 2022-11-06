<?php 
include("../../../phpfiles/connection.php"); 

$id = $_POST['userid'];
$query = "SELECT * FROM tblhousehold WHERE household_id = '$id'";
$result = $conn -> query($query);
$row = $result -> fetch_array();

if($row['status'] == "active")
{?>
    <div class="modal-content">
        <form action="edit_household.php"method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p style="font-size: 20px;">Are you sure you want to set this household as Inactive?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <input type="hidden" class="btn btn-success" name="id" value="<?php echo $_POST['userid'];?>">
                <input type="submit" class="btn btn-success" name="chin" value="Confirm">
            </div>
        </form>
    </div>
<?php
}
?>





