<div class="modal-content">
    <form action="add_document.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="type" name="type" required>
                        <label for="type">Document Type</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="price" name="price" required>
                        <label for="price">Price</label>
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

