<?php 
include("../../../phpfiles/connection.php"); 
$query = "SELECT id, concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table ORDER BY Fullname ASC;";
$result = $conn -> query($query);
?>

<div class="modal-content">
    <form action="add_household.php" autocomplete="off" method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Household</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md pt-2">
                        <div>
                            <label for="id" class="p-1">Family Head(Search the name of the resident.)</label>
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
            <input type="submit" class="btn btn-success" name="add" value="Add">
        </div>
    </form>
</div>
