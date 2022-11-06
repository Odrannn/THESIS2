<?php

// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT * FROM tblofficial WHERE name LIKE '%".$_POST['name']."%' OR official_id LIKE '%".$_POST['name']."%' OR position LIKE '%".$_POST['name']."%' OR status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["official_id"]; ?></td>
            <td><?php echo $row["resident_id"]; ?></td>
            <td><?php echo $row["user_id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["position"]; ?></td>
            <td><?php echo $row["term_start"]; ?></td>
            <td><?php echo $row["term_end"]; 
            if($row["term_end"] == date("Y-m-d")){
                /* official end query */
                $query11 = "UPDATE tblofficial SET status = 'term ended' WHERE official_id = " . $row["official_id"] . ";";
                $result11 = $conn -> query($query11);
            }
            ?></td>
            <td style ="text-align:center;"><div style ="width: 120px;" class="btn btn-outline-<?php if($row["status"]=='active'){echo 'success';} else {
                echo 'danger';
            }
            ?>"><?php echo $row["status"]; ?></div></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['official_id']; ?>" class="editofficial btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                <button data-id="<?php echo $row['official_id']; ?>" class="endterm btn btn-danger" <?php if($row["status"]=='term ended'){ echo 'disabled'; } ?>><i class="fa-sharp fa-solid fa-hourglass-end"></i></button>
                </div>
            </td>
        </tr>
        <?php } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}

?>
