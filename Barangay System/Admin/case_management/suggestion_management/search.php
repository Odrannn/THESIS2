<?php
// Create connection
include('../../../phpfiles/connection.php');
$sql = "SELECT * FROM suggestion_table WHERE suggestion_ID LIKE '%".$_POST['name']."%' OR suggestion_nature LIKE '%".$_POST['name']."%' OR suggestion_date LIKE '%".$_POST['name']."%' OR suggestion_status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["suggestion_ID"]; ?></td>
            <td><?php echo $row["official_ID"]; ?></td>
            <td><?php echo $row["sender_ID"]; ?></td>
            <td><?php echo $row["suggestion_nature"]; ?></td>
            <td><?php echo $row["suggestion_desc"]; ?></td>
            <td><?php echo $row["suggestion_date"]; ?></td>
            <td><?php echo $row["suggestion_feedback"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row["suggestion_status"]=='noticed'){echo 'success';}
            else if($row["suggestion_status"]=='pending'){
                echo 'primary';
            }
            ?>"><?php echo $row["suggestion_status"]; ?></div></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['suggestion_ID']; ?>" class="sendfeedback btn btn-primary"><i class="fa-solid fa-reply"></i></button>
                </div>
            </td>
        </tr>
        <?php } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}
?>
<!-- reply suggestion script-->
<script>
        $(document).ready(function(){
            $('.sendfeedback').click(function(){
                var userid = $(this).data('id');
                $.ajax({url: "reply_suggestion_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>