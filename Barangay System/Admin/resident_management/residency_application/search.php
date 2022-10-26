<?php

// Create connection
include('../../../phpfiles/connection.php');
$sql = "SELECT * FROM registration WHERE fname LIKE '%".$_POST['name']."%' OR mname LIKE '%".$_POST['name']."%' OR lname LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["fname"]; ?></td>
            <td><?php echo $row["mname"]; ?></td>
            <td><?php echo $row["lname"]; ?></td>
            <td><?php echo $row["suffix"]; ?></td>
            <td><?php echo $row["gender"]; ?></td>
            <td><?php echo $row["birthplace"]; ?></td>
            <td><?php echo $row["civilstatus"]; ?></td>
            <td><?php echo $row["birthday"]; ?></td>
            <td><?php 
                $dateOfBirth = $row["birthday"];
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                echo $diff->format('%y');
            ?></td>
            <td><?php echo $row["unitnumber"]; ?></td>
            <td><?php echo $row["purok"]; ?></td>
            <td><?php echo $row["sitio"]; ?></td>
            <td><?php echo $row["street"]; ?></td>
            <td><?php echo $row["subdivision"]; ?></td>
            <td><?php echo $row["contactnumber"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["religion"]; ?></td>
            <td><?php echo $row["occupation"]; ?></td>
            <td><?php echo $row["educational"]; ?></td>
            <td><?php echo $row["nationality"]; ?></td>
            <td><?php echo $row["disability"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 100px;" class="btn btn-outline-<?php if($row["status"]=='accepted'){echo 'success';} else {
                                            echo 'primary';
                                        }
                                        ?>"><?php echo $row["status"]; ?></td>
            <td><button data-id="<?php echo $row['id']; ?>" class="userinfo btn btn-primary">View</button></td>
        </tr>
        <?php
    } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}

?>
<script>
    $(document).ready(function(){
        $('.userinfo').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "application_details.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#appModal').modal('show');
        });
    });
</script>