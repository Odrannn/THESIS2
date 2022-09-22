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
                        <input class="form-control" name="type" id="type" value="<?php echo $row['document_type']; ?>" required>
                        <label for="type">Document Type</label>
                    </div>
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" name="price" id="price" value="<?php echo $row['price']; ?>" required>
                        <label for="type">Price (Php)</label>
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

