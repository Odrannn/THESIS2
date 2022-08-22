<?php 

if(isset($_POST['userid'])){

    $conn = new mysqli("localhost", "root", "", "bgy_system");
    $query = "SELECT * FROM resident_table WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row = mysqli_fetch_array($result)?>

    <div class='table-responsive'><table class='table table-bordered'>
        <tr>
            <td colspan='4'><b>Name: </b><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] ?></td>
            <td><b>Gender: </b><?php echo $row["gender"] ?></td>
        </tr>
        <tr>
            <td><b>Place Birth: </b><?php echo $row["birthplace"] ?></td>
            <td><b>Age: </b><?php echo $row["age"] ?></td>
            <td colspan='2'><b>Birthday: </b><?php echo $row["birthday"] ?></td>
            <td><b>Civil Status: </b><?php echo $row["civilstatus"] ?></td>
        </tr>
        <tr><td colspan='5'><b>Address</b></td></tr>
        <tr>
            <td><b>Household: </b><?php echo $row["unitnumber"] ?></td>
            <td><b>Purok: </b><?php echo $row["purok"] ?></td>
            <td><b>Sitio: </b><?php echo $row["purok"] ?></td>
            <td><b>Street: </b><?php echo $row["purok"] ?></td>
            <td><b>Subdivision: </b><?php echo $row["purok"] ?></td>

            
        <tr>
            <th>Contact Number</th>
            <th>Religion</th>
            <th>Occupation</th>
            <th colspan='2'>Email</th>
        </tr>
        <tr>
            <td><?php echo $row["contactnumber"] ?></td>
            <td><?php echo $row["religion"] ?></td>
            <td><?php echo $row["occupation"] ?></td>
            <td colspan='2'><?php echo $row["email"] ?></td>
        </tr>
        <tr>
            <td colspan='2'><b>Highest Educational Attainment: </b><?php echo $row["education"] ?></td>
            <td><b>Nationality: </b><?php echo $row["nationality"] ?></td>
            <td><b>Disability: </b><?php echo $row["disability"] ?></td>
            <td><b>Status: </b><?php echo $row["status"] ?></td>
        </tr>
    </table></div>
    <?php
} ?>

    