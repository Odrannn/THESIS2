<?php
session_start();
// Create connection
include('../../phpfiles/connection.php');
$sql = "SELECT U.*, S.fname, S.mname, S.lname, S.suffix FROM tbluser U INNER JOIN resident_table S ON U.id = S.user_id WHERE S.fname LIKE '%".$_POST['name']."%' OR S.mname LIKE '%".$_POST['name']."%' OR S.lname LIKE '%".$_POST['name']."%' OR U.id LIKE '%".$_POST['name']."%' OR U.type LIKE '%".$_POST['name']."%' OR U.status LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);

$query1 = "SELECT * FROM tbluser WHERE id='".$_SESSION['user_id']."';";
$result1 = $conn -> query($query1);
$row1 = $result1 -> fetch_array();
$typeOfUser = $row1['type'];
if(mysqli_num_rows($result)>0){
	while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["fname"] . ' ' . $row["mname"] . ' ' . $row["lname"] . ' ' . $row["suffix"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["password"]; ?></td>
            <td><?php echo $row["type"]; ?></td>
            <td style ="text-align:center;"><div style ="width: 120px;" class="btn btn-outline-<?php if($row["status"]=='active'){echo 'success';} else {
                echo 'danger';
            }
            ?>"><?php echo $row["status"]; ?></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['id']; ?>" class="edituser btn btn-warning" 
                <?php if($row["type"] != 'user' && $row["type"] != 'hadmin' && $typeOfUser != 'admin0' || $typeOfUser == 'hadmin'){ echo 'disabled';}?>><i class="fa-solid fa-pen-to-square"></i></button>
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
        $('.edituser').click(function(){
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