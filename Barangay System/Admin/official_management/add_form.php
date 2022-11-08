<?php 
include("../../phpfiles/connection.php"); 
$query = "SELECT R.id, R.contactnumber, concat_ws(' ',R.fname,R.mname,R.lname) as Fullname, U.type FROM resident_table R INNER JOIN tbluser U ON R.user_id = U.id WHERE U.type = 'user' AND R.status ='active' ORDER BY Fullname ASC;";
$result = $conn -> query($query);
?>

<div class="modal-content">
<form action="add_official.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Official</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="residentID" name="residentID" placeholder="Resident ID.." oninput="this.value = this.value.replace(/[^a-z0-9]/gi, '').replace(/(\..*)\./gi, '$1')" list="reslist" required>
                        <label for="residentID">Resident ID</label>
                        <datalist id="reslist">
                            <?php while($row = $result -> fetch_array()) { ?>
                                <option value="<?php echo $row['id']?>"><?php echo $row['Fullname']?></option>
                            <?php } ?>
                        </datalist>
                    </div>  
                </div>
                <div class="col-md pt-2">
                    <div class="form-floating">
                        <select class="form-control" id="position" name="position" required>
                            <option value="" disabled>-Select Position-</option>
                            <option value="Chairman" <?php 
                            //validate if chairman existing
                            $exquery2 = "SELECT * FROM tblofficial WHERE position = 'Chairman' AND status = 'active';";
                            $exresult2 = $conn -> query($exquery2); 

                            if (mysqli_num_rows($exresult2)==1){ echo 'disabled'; }
                            ?>>Chairman</option>
                            <option value="Kagawad" <?php 
                            //validate kagawad counts
                            $exquery2 = "SELECT * FROM tblofficial WHERE position = 'Kagawad' AND status = 'active';";
                            $exresult2 = $conn -> query($exquery2); 

                            if (mysqli_num_rows($exresult2)==8){ echo 'disabled'; }
                            ?>>Kagawad</option>
                            <option value="Secretary" <?php 
                            //validate if chairman existing
                            $exquery2 = "SELECT * FROM tblofficial WHERE position = 'Secretary' AND status = 'active';";
                            $exresult2 = $conn -> query($exquery2); 

                            if (mysqli_num_rows($exresult2)==1){ echo 'disabled'; }
                            ?>>Secretary</option>
                            <option value="Exo" <?php 
                            //validate if chairman existing
                            $exquery2 = "SELECT * FROM tblofficial WHERE position = 'Exo' AND status = 'active';";
                            $exresult2 = $conn -> query($exquery2); 

                            if (mysqli_num_rows($exresult2)==1){ echo 'disabled'; }
                            ?>>Ex-o</option>
                        </select>
                        <label for="position">Position</label>
                    </div>
                </div>
            </div>
            <div class="row">
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
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_official" value="Add">
    </div>
    </form>
</div>
<script type="text/javascript">
    function lettersnumbersOnly(input){
        var regex = /[^a-z0-9]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>

    