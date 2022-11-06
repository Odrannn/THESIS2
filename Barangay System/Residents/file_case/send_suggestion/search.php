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

$sql = "SELECT * FROM suggestion_table WHERE sender_ID = '$residentID' AND (suggestion_ID LIKE '%".$_POST['name']."%' OR suggestion_nature LIKE '%".$_POST['name']."%' OR suggestion_date LIKE '%".$_POST['name']."%' OR suggestion_status LIKE '%".$_POST['name']."%')";
$result = mysqli_query($conn, $sql);

$query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
$result1 = $conn -> query($query1);
$row1 = $result1 -> fetch_array();
$typeOfUser = $row1['type'];

if(mysqli_num_rows($result)>0){
	while($row1 = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row1["suggestion_ID"]; ?></td>
            <td><?php echo $row1["suggestion_nature"]; ?></td>
            <td><?php echo $row1["suggestion_desc"]; ?></td>
            <td><?php echo $row1["suggestion_date"]; ?></td>
            <td><?php echo $row1["suggestion_feedback"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row1["suggestion_status"]=='noticed'){echo 'success';}
            else if($row1["suggestion_status"]=='pending'){
                echo 'primary';
            }
            ?>"><?php echo $row1["suggestion_status"]; ?></td>
            <td><button data-id="<?php echo $row1["suggestion_ID"]?>" class="viewsugg btn btn-primary"><i class="fa-solid fa-eye"></i></button>   
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
        $('.viewsugg').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "view_suggestions_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#viewModal').modal('show');
        });
    });
</script>