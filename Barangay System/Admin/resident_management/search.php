<?php

// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT * FROM resident_table WHERE fname LIKE '%".$_POST['name']."%' OR mname LIKE '%".$_POST['name']."%' OR lname LIKE '%".$_POST['name']."%' OR id LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["user_id"]; ?></td>
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
            <td><?php echo $row["household_ID"]; ?></td>
            <td><?php echo $row["unitnumber"]; ?></td>
            <td><?php echo $row["purok"]; ?></td>
            <td><?php echo $row["sitio"]; ?></td>
            <td><?php echo $row["street"]; ?></td>
            <td><?php echo $row["subdivision"]; ?></td>
            <td><?php echo $row["contactnumber"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["religion"]; ?></td>
            <td><?php echo $row["occupation"]; ?></td>
            <td><?php echo $row["education"]; ?></td>
            <td><?php echo $row["nationality"]; ?></td>
            <td><?php echo $row["disability"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 100px;" class="btn btn-outline-<?php if($row["status"]=='active'){echo 'success';} else {
                                            echo 'danger';
                                        }
                                        ?>"><?php echo $row["status"]; ?></div></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['id']; ?>" class="userinfo btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                <button data-id="<?php echo $row['id']; ?>" class="editresident btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </td>
        </tr>
        <?php
    } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}

?>
<!-- Edit resident script-->
<script>
    $(document).ready(function(){
        $('.editresident').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "edit_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#editModal').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.userinfo').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "resident_details.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#viewModal').modal('show');
        });
    });
</script>