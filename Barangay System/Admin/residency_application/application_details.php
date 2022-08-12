<?php 


if(isset($_POST['userid'])){
    $output = '';

    $conn = new mysqli("localhost", "root", "", "bgy_system");
    $query = "SELECT * FROM registration WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query);

    $output .= "<div class='table-responsive'><table class='table table-bordered'>";

    while($row = mysqli_fetch_array($result)){
    $output .= "<tr>
        <td><b>First Name: </b>". $row["fname"] . "</td>
        <td><b>Middle Name: </b>". $row["mname"] . "</td>
        <td><b>Last Name: </b>". $row["lname"] . "</td>
        <td><b>Gender: </b>". $row["gender"] . "</td>
    </tr>
    <tr>
        <td><b>Place Birth: </b>". $row["birthplace"] . "</td>
        <td><b>Household ID: </b>". $row["unitnumber"] . "</td>
        <td><b>Birthday: </b>". $row["birthday"] . "</td>
        <td><b>Age: </b>". $row["age"] . "</td>
    </tr>
    <tr>
        <td colspan='2'><b>Address: </b>". $row["birthplace"] . "</td>
        <td><b>Purok: </b>". $row["purok"] . "</td>
        <td><b>Civil Status: </b>". $row["civilstatus"] . "</td>
    <tr>
        <th>Contact Number</th>
        <th>Email</th>
        <th>Religion</th>
        <th>Occupation</th>
    </tr>
    <tr>
        <td>" .$row["contactnumber"] . "</td>
        <td>" .$row["email"] . "</td>
        <td>" .$row["religion"] . "</td>
        <td>" .$row["occupation"] . "</td>
    </tr>
    <tr>
        <td colspan='2'><b>Highest Educational Attainment: </b>College</td>
        <td><b>Nationality: </b>" .$row["nationality"] . "</td>
        <td><b>Disability: </b>" .$row["disability"] . "</td>
    </tr>
    <tr>
        <th colspan='4'>Valid ID</th>
    </tr>
    <tr>
        <td colspan='4'>
            <img src='../icons/sample.jpg' style='width: 100%;'>
        </td>
    </tr>
    ";
    }
    $output .= "</table></div>";
    echo $output;
}
    