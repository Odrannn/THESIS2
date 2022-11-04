
<?php 
session_start();
include("../../phpfiles/connection.php");
$annID = $_POST['annID'];
$query = "SELECT * FROM announcement where id ='$annID';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();

?>

<div class="modal-content">
    <form action="../../generate-document/generate_document.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="mb-4 pb-4 p-0" colspan="2"><img src="../../announcement_uploads/<?php echo $row['img_url']?>" class="rounded" style='width: 100%;'></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Title:</b></td>
                        <td class="m-0 p-0"><?php echo $row['title']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Description:</b></td>
                        <td class="m-0 p-0"><?php echo $row['descrip']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Date & Time Posted:</b></td>
                        <td class="m-0 p-0"><?php 
                            $orgDate = $row['date'];  
                            $newDate = date("Y-m-d, h:i:s a", strtotime($orgDate));  
                            echo $newDate;?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>
    </form>
</div>

