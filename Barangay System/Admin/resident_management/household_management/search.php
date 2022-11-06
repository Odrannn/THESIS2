<?php

// Create connection
include('../../../phpfiles/connection.php');
$sql = "SELECT H.*, R.fname, R.mname, R.lname, R.suffix FROM tblhousehold H INNER JOIN resident_table R ON H.household_head_ID = R.id WHERE R.fname LIKE '%".$_POST['name']."%' OR R.mname LIKE '%".$_POST['name']."%' OR R.lname LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {?>
        <tr>
            <td><?php echo $row["household_id"]; ?></td>
            <td><?php echo $row["household_name"]; ?></td>
            <td><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"]; ?></td>
            <td><?php echo $row["household_member"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td><button data-id="<?php echo $row['household_id']; ?>" class="edithousehold btn btn-danger" <?php
                if($row["status"] == "inactive"){
                    echo "disabled";
                } 
            ?>><i class="fa-solid fa-box-archive"></i></button></td>
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
        $('.edithousehold').click(function(){
            var userid = $(this).data('id');
            $.ajax({url: "edit_household_form.php",
            method:'post',
            data: {userid:userid},
                
            success: function(result){
                $(".modal-dialog").html(result);
            }});
            $('#editModal').modal('show');
        });
    });
</script>