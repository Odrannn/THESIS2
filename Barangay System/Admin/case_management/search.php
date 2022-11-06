<?php
// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT * FROM complaint_table WHERE complaint_ID LIKE '%".$_POST['name']."%' OR complaint_nature LIKE '%".$_POST['name']."%' OR complaint_date LIKE '%".$_POST['name']."%' OR complaint_status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["complaint_ID"]; ?></td>
            <td><?php echo $row["official_ID"]; ?></td>
            <td><?php echo $row["sender_ID"]; ?></td>
            <td><?php echo $row["complaint_nature"]; ?></td>
            <td><?php echo $row["comp_desc"]; ?></td>
            <td><?php echo $row["complaint_date"]; ?></td>
            <td><?php echo $row["img_proof"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 150px;" class="btn btn-outline-<?php if($row["complaint_status"]=='solved'){echo 'success';}
            else if($row["complaint_status"]=='pending'){
                echo 'primary';
            }
            ?>"><?php echo $row["complaint_status"]; ?></div></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['complaint_ID']; ?>" class="editcomplaint btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </td>
        </tr>
        <?php } 
}
else{
	echo "<tr><td colspan = '26'>0 result's found</td></tr>";
}
?>
<!-- Edit complaint script-->
<script>
    $(document).ready(function(){
        $('.editcomplaint').click(function(){
            var userid = $(this).data('id');
            $.ajax({
            url: "edit_complaint_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#editModal').modal('show');
        });
    });
</script>