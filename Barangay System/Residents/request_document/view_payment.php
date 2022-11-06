<?php 
session_start();
include("../../phpfiles/connection.php");
$query = "SELECT R.*, T.document_type, T.price FROM document_request R INNER JOIN document_type T ON R.document_ID = T.id WHERE request_ID = '".$_POST['reqid']."';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="m-0 p-0" colspan="2"><img src="../../request_uploads/<?php echo $row['payment']?>" class="rounded" style='width: 100%;'></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>
</div>

