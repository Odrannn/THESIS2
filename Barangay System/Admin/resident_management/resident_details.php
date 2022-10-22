<?php 

if(isset($_POST['userid'])){

    include("../../phpfiles/connection.php");
    $query = "SELECT * FROM resident_table WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Resident Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col pt-2">
                        <img src="" alt="resident image.." class="img-fluid"    >
                    </div>
                    <div class="col pt-2">
                        <p class="m-0"><b>Name: </b><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"] ?></p>
                        <p class="m-0"><b>Gender: </b><?php echo $row["gender"] ?></p>
                        <p class="m-0"><b>Place Birth: </b><?php echo $row["birthplace"] ?></p>
                        <p class="m-0"><b>Birthday: </b><?php echo $row["birthday"] ?></p>
                        <p class="m-0"><b>Age: </b><?php 
                                            $dateOfBirth = $row["birthday"];
                                            $today = date("Y-m-d");
                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                            echo $diff->format('%y');
                                        ?></p>
                        <p class="m-0"><b>Civil Status: </b><?php echo $row["civilstatus"] ?></p>
                        <p class="m-0"><b>Household ID: </b><?php echo $row["household_ID"] ?></p>
                        <p class="m-0"><b>Address: </b><?php echo $row["unitnumber"] . " " . $row["sitio"] . " " . $row["purok"] . " " . $row["subdivision"] . " " . $row["street"] . ", Manila City"?></p>
                        <p class="m-0"><b>Contact Number: </b><?php echo $row["contactnumber"] ?></p>
                        <p class="m-0"><b>Religion: </b><?php echo $row["religion"] ?></p>
                        <p class="m-0"><b>Occupation: </b><?php echo $row["occupation"] ?></p>
                        <p class="m-0"><b>Email: </b><?php echo $row["email"] ?></p>
                        <p class="m-0"><b>Highest Educational Attainment: </b><?php echo $row["education"] ?></p>
                        <p class="m-0"><b>Nationality: </b><?php echo $row["nationality"] ?></p>
                        <p class="m-0"><b>Disability: </b><?php echo $row["disability"] ?></p>
                        <p class="m-0"><b>Status: </b><?php echo $row["status"] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    <?php
} ?>

    