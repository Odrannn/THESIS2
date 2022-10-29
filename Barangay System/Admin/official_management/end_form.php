<?php 
?>
<div class="modal-content">
<form action="end_term.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">End Offical Term</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div style ="text-align:center;">
                Are you sure you want to end this official's term?
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" class="btn btn-success" name="id" value="<?php echo $_POST['offid']?>">
        <input type="submit" class="btn btn-success" name="end_term" value="Confirm">
    </div>
    </form>
</div>


    