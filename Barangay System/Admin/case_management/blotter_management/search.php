<?php
// Create connection
session_start();
include('../../../phpfiles/connection.php');
$sql = "SELECT * FROM blotter_table WHERE blotter_ID LIKE '%".$_POST['name']."%' OR complainee_name LIKE '%".$_POST['name']."%' OR blotter_date LIKE '%".$_POST['name']."%' OR blotter_accusation LIKE '%".$_POST['name']."%' 
OR settlement_schedule LIKE '%".$_POST['name']."%' OR status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row1 = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row1["blotter_ID"]; ?></td>
            <td><?php echo $row1["complainee_name"]; ?></td>
            <td><?php echo $row1["blotter_accusation"]; ?></td>
            <td><?php echo $row1["blotter_details"]; ?></td>
            <td><?php echo $row1["settlement_schedule"]; ?></td>
            <td><?php echo $row1["settlement_time"]; ?></td>
            <td><?php echo $row1["result_of_settlement"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row1["status"]=='settled'){echo 'success';}
            else if($row1["status"]=='unscheduled'){
                echo 'warning';
            } else if($row1["status"]=='scheduled'){
                echo 'primary';
            } else {
                echo 'danger';
            }
            ?>"><?php echo $row1["status"]; ?></td>
            <td>
            <div class="btn-group" role="group" aria-label="Basic example">    
                <button data-id="<?php echo $row1["blotter_ID"]?>" class="viewbl btn btn-primary"><i class="fa-solid fa-eye"></i></button>   
                <button data-id="<?php echo $row1["blotter_ID"]?>" class="xbl btn btn-danger" <?php
                if($row1["status"] == 'cancelled'){echo 'disabled';}
                ?>><i class="fa-solid fa-xmark"></i></button>   
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