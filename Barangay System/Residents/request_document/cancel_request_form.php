<?php
if(isset($_POST['reqid'])){?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cancel Request?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                Are you sure you want to cancel your request?
            </div>
        </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <form action="cancel_request.php" method="post">
                    <input type="hidden" name="req_id" value="<?php echo $_POST['reqid'] ?>">
                    <input type="submit" class="btn btn-primary" name="cancel" value="Confirm">
                </form>
            </div>
        </div>
    <?php
}
?>
