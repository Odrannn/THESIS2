<?php 
include("../../phpfiles/connection.php"); 
$query = "SELECT id, concat_ws(' ',fname,mname,lname) as Fullname FROM resident_table
            ORDER BY Fullname ASC;";
$result = $conn -> query($query);
?>

<div class="modal-content">
    <form action="add_log.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="id" name="id" list="reslist" required>
                        <label for="type">Patient ID (Search the name of the resident.)</label>
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
                        <textarea class="form-control" name="reason" id="reason" row="5" required></textarea>
                        <label for="reason">Reason For Visit</label>
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

