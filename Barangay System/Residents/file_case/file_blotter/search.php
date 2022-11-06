<?php
session_start();

// Create connection
include('../../../phpfiles/connection.php');

$userid = $_SESSION['user_id'];
//get resident id
$query = "SELECT id FROM resident_table WHERE user_id = '$userid'";
$result = $conn -> query($query);
$row = $result->fetch_array();
$residentID = $row['id'];

$sql = "SELECT * FROM blotter_table WHERE complainant_ID = '$residentID' AND (blotter_ID LIKE '%".$_POST['name']."%' OR complainee_name LIKE '%".$_POST['name']."%' OR blotter_date LIKE '%".$_POST['name']."%' OR blotter_accusation LIKE '%".$_POST['name']."%' 
OR settlement_schedule LIKE '%".$_POST['name']."%' OR status LIKE '%".$_POST['name']."%')";
$result = mysqli_query($conn, $sql);

$query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
$result1 = $conn -> query($query1);
$row1 = $result1 -> fetch_array();
$typeOfUser = $row1['type'];

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
<!-- view script-->
<script>
    $(document).ready(function(){
        $('.viewbl').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "view_blotters_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#viewModal').modal('show');
        });
    });
</script>

<!-- x script-->
<script>
    $(document).ready(function(){
        $('.xbl').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "cancel_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#xModal').modal('show');
        });
    });
</script>