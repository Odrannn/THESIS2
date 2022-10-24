<div class="modal-content">
    <form action="import.php" method="post" name="uploadCSV" enctype="multipart/form-data">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 50%;overflow-y: auto;">
            <div>
                <label for = "">Choose CSV File</label>
                <input type = "file" name="file" accept=".csv">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit" name="import">Import</button>
        </div>
    </form>
</div>

    