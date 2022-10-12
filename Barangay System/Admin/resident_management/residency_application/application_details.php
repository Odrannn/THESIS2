<?php 
if(isset($_POST['userid'])){
    include("../../../phpfiles/connection.php");
    $query = "SELECT * FROM registration WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Application Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col pt-2">
                        <p class="m-0"><b>Name: </b><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"] ?></p>
                        <p class="m-0"><b>Gender: </b><?php echo $row["gender"] ?></p>
                        <p class="m-0"><b>Place Birth: </b><?php echo $row["birthplace"] ?></p>
                        <p class="m-0"><b>Age: </b><?php echo $row["age"] ?></p>
                        <p class="m-0"><b>Birthday: </b><?php echo $row["birthday"] ?></p>
                        <p class="m-0"><b>Civil Status: </b><?php echo $row["civilstatus"] ?></p>
                        <p class="m-0"><b>Address: </b><?php echo $row["unitnumber"] . " " . $row["sitio"] . " " . $row["purok"] . " " . $row["subdivision"] . " " . $row["street"] . ", Manila City"?></p>
                        <p class="m-0"><b>Contact Number: </b><?php echo $row["contactnumber"] ?></p>
                        <p class="m-0"><b>Religion: </b><?php echo $row["religion"] ?></p>
                        <p class="m-0"><b>Occupation: </b><?php echo $row["occupation"] ?></p>
                        <p class="m-0"><b>Email: </b><?php echo $row["email"] ?></p>
                        <p class="m-0"><b>Highest Educational Attainment: </b><?php echo $row["educational"] ?></p>
                        <p class="m-0"><b>Nationality: </b><?php echo $row["nationality"] ?></p>
                        <p class="m-0"><b>Disability: </b><?php echo $row["disability"] ?></p>
                        <p class="m-0"><b>Status: </b><?php echo $row["status"] ?></p>
                        <p class="m-0"><b>Valid ID:</p>
                    </div>
                </div>
                <div class="row">
                    <img src='../../../Login/validID/<?php echo $row["img_path"] ?>' style='width: 100%;'>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <form action="accept_application.php" method="post">
                    <input type="hidden" name="app_id" value="<?php echo $_POST['userid'] ?>">
                    <input type="submit" class="btn btn-primary" name="accept_application" value="Accept" 
                    <?php
                        if($row["status"]=="accepted"){
                            echo "disabled";
                        }
                    ?>>
                </form>
            </div>
        </div>
    <?php
}
?>

    