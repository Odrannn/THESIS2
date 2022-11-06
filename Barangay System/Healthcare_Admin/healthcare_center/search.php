<?php
// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT * FROM healthcare_logs WHERE id LIKE '%".$_POST['name']."%' OR fullname LIKE '%".$_POST['name']."%' OR date LIKE '%".$_POST['name']."%' OR reason LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["patient_id"]; ?></td>
            <td><?php echo $row["fullname"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo date("h:i a", strtotime($row["time"])) ?></td>
            <td><?php echo $row["reason"]; ?></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['id']; ?>" class="editlog btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </td>
        </tr>
        <?php } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}
?>
<!-- Edit user script-->
<script>
    $(document).ready(function(){
        $('.editlog').click(function(){
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