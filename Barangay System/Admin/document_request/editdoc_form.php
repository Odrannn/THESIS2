<?php 
include("../../phpfiles/connection.php"); 
$query = "SELECT * FROM document_type WHERE id = '".$_POST['userid']."';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();
?>

<div class="modal-content">
    <form action="save_document.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" name="price" id="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $row['price']; ?>" required>
                        <label for="type">Price (Php)</label>
                    </div>
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <select class="form-control" name="av" id="av">
                            <option value="yes" <?php if ($row['availability'] == 'yes'){ echo 'selected'; }?>>yes</option>
                            <option value="no" <?php if ($row['availability'] == 'no'){ echo 'selected'; }?>>no</option>
                        </select>
                        <label for="av">Availability</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="submit" class="btn btn-success" name="save" value="Update">
    </div>
    </form>
</div>

