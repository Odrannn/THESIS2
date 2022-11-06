<?php 
if(isset($_POST['userid'])){?>
    
<div class="modal-content">
    <form action="cancel_blotter.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Blotter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style = "height: 50%;overflow-y: auto;">
        <div class="container">
            Are you sure you want to cancel your blotter?
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <form action="cancel_blotter.php" method="post">
                <input type="hidden" name="blotter_id" value="<?php echo $_POST['userid'] ?>">
                <input type="submit" class="btn btn-primary" name="cancel" value="Confirm">
            </form>
    </div>
    </form>
</div>
    
<?php
} ?>

    