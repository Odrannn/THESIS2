<?php 


if(isset($_POST['userid'])){
    $conn = new mysqli("localhost", "root", "", "bgy_system");
    $query = "SELECT * FROM registration WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Application Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class='table-responsive'>
                <table class='table table-bordered'>
                    <tr>
                        <td><b>First Name: </b><?php echo $row["fname"] ?></td>
                        <td><b>Middle Name: </b><?php echo $row["mname"] ?></td>
                        <td><b>Last Name: </b><?php echo $row["lname"] ?></td>
                        <td><b>Gender: </b><?php echo $row["gender"] ?></td>
                    </tr>
                    <tr>
                        <td><b>Place Birth: </b><?php echo $row["birthplace"] ?></td>
                        <td><b>Household ID: </b><?php echo $row["unitnumber"] ?></td>
                        <td><b>Birthday: </b><?php echo $row["birthday"] ?></td>
                        <td><b>Age: </b><?php echo $row["age"] ?></td>
                    </tr>
                    <tr>
                        <td colspan='2'><b>Address: </b></td>
                        <td><b>Purok: </b><?php echo $row["purok"] ?></td>
                        <td><b>Civil Status: </b><?php echo $row["civilstatus"] ?></td>
                    <tr>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Religion</th>
                        <th>Occupation</th>
                    </tr>
                    <tr>
                        <td><?php echo $row["contactnumber"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                        <td><?php echo $row["religion"] ?></td>
                        <td><?php echo $row["occupation"] ?></td>
                    </tr>
                    <tr>
                        <td><b>Highest Educational Attainment: </b><?php echo $row["educational"] ?></td>
                        <td><b>Nationality: </b><?php echo $row["nationality"] ?></td>
                        <td><b>Disability: </b><?php echo $row["disability"] ?></td>
                        <td><b>Status: </b><?php echo $row["status"] ?></td>
                    </tr>
                    <tr>
                        <th colspan='4'>Valid ID</th>
                    </tr>
                    <tr>
                        <td colspan='4'>
                            <img src='../icons/sample.jpg' style='width: 100%;'>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <form action="accept_application.php" method="post">
                    <input type="hidden" name="app_id" value="<?php echo $_POST['userid'] ?>">
                    <input type="submit" class="btn btn-primary" name="accept_application" value="Accept">
                </form>
            </div>
        </div>
    <?php
}
?>

    