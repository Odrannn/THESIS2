<?php 
include("../../phpfiles/connection.php"); 
$id = $_POST['rid'];
?>
<div class="modal-content">
    <form action="edit_member.php"method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <p style="font-size: 20px;">Are you sure you want to remove this resident as a member of your household?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" class="btn btn-success" name="id" value="<?php echo $id;?>">
            <input type="submit" class="btn btn-success" name="confirm" value="Confirm">
        </div>
    </form>
</div>





