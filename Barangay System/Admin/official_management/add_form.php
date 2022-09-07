<form action="add_official.php" method="post">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Official</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="residentID" name="residentID" placeholder="Resident ID.." required>
                        <label for="residentID">Resident ID</label>
                    </div>  
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <select class="form-control" id="position" name="position" required>
                            <option value="">-Select-</option>
                            <option value="Chairman">Chairman</option>
                            <option value="Kagawad">Kagawad</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Exo">Ex-o</option>
                        </select>
                        <label for="position">Position</label>
                    </div>
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="date" id="term_start" name="term_start" required>
                        <label for="term_start">Term Start</label>
                    </div>
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="date" id="term_end" name="term_end" required>
                        <label for="term_start">Term End</label>
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_official" value="Add">
    </div>
</div>
</form>

    