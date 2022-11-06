<?php

// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT D.*, T.* FROM document_request D INNER JOIN document_type T ON D.document_ID = T.id WHERE document_type LIKE '%".$_POST['name']."%' OR request_ID LIKE '%".$_POST['name']."%' OR status LIKE '%".$_POST['name']."%' OR request_date LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["request_ID"]; ?></td>
            <td><?php echo $row["official_ID"]; ?></td>
            <td><?php echo $row["resident_ID"]; ?></td>
            <td><?php echo $row["document_type"]; ?></td>
            <td><?php echo $row["purpose"]; ?></td>
            <td><?php echo $row["quantity"]; ?></td>
            <td><?php echo $row["payment"]; ?></td>
            <td><?php echo $row["request_date"]; ?></td>
            <td style ="text-align:center;" colspan='2'><div style ="width: 200px;" class="btn btn-outline-<?php if($row["status"]=='completed'){echo 'success';}
            else if($row["status"]=='pending for verification' || $row["status"]=='pending for payment'){
                echo 'primary';
            } else {
                echo 'danger';
            }
            ?>"><?php echo $row["status"]; ?></div></td>
            <td><?php
            if($row["status"]!='cancelled' && $row["status"]!='pending for payment'){
            ?>
                <button data-id="<?php echo $row['request_ID']; ?>" class="viewreq btn btn-primary"><i class="fa-solid fa-eye"></i></button></td>
            <?php }?>
        </tr>
        <?php } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}

?>
