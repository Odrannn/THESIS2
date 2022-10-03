<?php 
include("../../../phpfiles/connection.php");
?>

<div class="modal-content">
    <form action="set_schedule.php" autocomplete="off" method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Set Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="date" id="dateh" name="dateh" required>
                            <label for="date">Date</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="time" id="timeh" name="timeh" required>
                            <label for="start">Time</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="blotter_id" value="<?php echo $_POST['blotterid']; ?>">
            <input type="submit" class="btn btn-success" name="set" value="Set">
        </div>
    </form>
</div>


