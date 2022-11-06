<?php
// Create connection
session_start();
include('../../../phpfiles/connection.php');
$sql = "SELECT * FROM blotter_table WHERE blotter_ID LIKE '%".$_POST['name']."%' OR complainee_name LIKE '%".$_POST['name']."%' OR blotter_date LIKE '%".$_POST['name']."%' OR blotter_accusation LIKE '%".$_POST['name']."%' 
OR settlement_schedule LIKE '%".$_POST['name']."%' OR status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>

                                    
        <tr>
            <td><?php echo $row["blotter_ID"]; ?></td>
            <td><?php echo $row["official_ID"]; ?></td>
            <td><?php echo $row["complainant_ID"]; ?></td>
            <td><?php echo $row["complainee_ID"]; ?></td>
            <td><?php echo $row["complainee_name"]; ?></td>
            <td><?php echo $row["blotter_date"]; ?></td>
            <td><?php echo $row["blotter_time"]; ?></td>
            <td><?php echo $row["blotter_accusation"]; ?></td>
            <td><?php echo $row["blotter_details"]; ?></td>
            <td><?php echo $row["settlement_schedule"]; ?></td>
            <td><?php echo $row["settlement_time"]; ?></td>
            <td><?php echo $row["result_of_settlement"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row["status"]=='settled'){echo 'success';}
            else if($row["status"]=='unscheduled'){
                echo 'warning';
            } else if($row["status"]=='scheduled'){
                echo 'primary';
            } else {
                echo 'danger';
            }
            ?>"><?php echo $row["status"]; ?></div></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <?php $off_id = $row['official_ID'];
                    $query2 = "SELECT * FROM tblofficial WHERE official_id = '$off_id'";
                    $result2 = $conn -> query($query2); 
                    $row2 = mysqli_fetch_array($result2)
                ?>
                <button data-id="<?php echo $row['blotter_ID']; ?>" class="setsched btn btn-primary"<?php 
                    if($off_id != ""){
                        if($row['status'] == 'settled' || $row['status'] == 'unsettled' || $row2['user_id'] != $_SESSION['user_id'])
                        {
                            echo "disabled"; 
                        }
                    } ?>><i class="fa-solid fa-calendar-days"></i></button>
                <button data-id="<?php echo $row['blotter_ID']; ?>" class="editblotter btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </td>
        </tr>
        <?php }
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}
?>
<!-- set schedule script-->
<script>
    $(document).ready(function(){
        $('.setsched').click(function(){
            var blotterid = $(this).data('id');
            $.ajax({url: "set_schedule_form.php",
            method:'post',
            data: {blotterid:blotterid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#setModal').modal('show');
        });
    });
</script>
<!-- Edit resident script-->
<script>
    $(document).ready(function(){
        $('.editblotter').click(function(){
            var blotterid = $(this).data('id');
            $.ajax({url: "edit_blotter_form.php",
            method:'post',
            data: {blotterid:blotterid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#editModal').modal('show');
        });
    });
</script>