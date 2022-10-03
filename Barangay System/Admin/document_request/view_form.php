<?php 
include("../../phpfiles/connection.php");
$query = "SELECT R.*, T.document_type, T.price FROM document_request R INNER JOIN document_type T ON R.document_ID = T.id WHERE request_ID = '".$_POST['userid']."';";
$result = $conn -> query($query);
$row = $result->fetch_assoc();

$quantity = (int)$row['quantity'];
$price = (float)$row['price'];
$total = (float)($quantity * $price);
?>

<div class="modal-content">
    <form action="generate_file.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="m-0 p-0"><b>Document type:</b></td>
                        <td class="m-0 p-0"><?php echo $row['document_type']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Purpose:</b></td>
                        <td class="m-0 p-0"><?php echo $row['purpose']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Price:</b></td>
                        <td class="m-0 p-0"><?php echo $row['price']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Quantity:</b></td>
                        <td class="m-0 p-0"><?php echo $row['quantity']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Date:</b></td>
                        <td class="m-0 p-0"><?php echo $row['request_date']?></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0"><b>Total amount:</b></td>
                        <td class="m-0 p-0"><?php echo $total?></td>
                    </tr>
                    <tr>
                        <td class="mx-0 px-0"><b>Payment:</b></td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0" colspan="2"><img src="../../request_uploads/<?php echo $row['payment']?>" class="rounded" style='width: 100%;'></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" name="id" value="<?php echo $row['request_ID'];?>">
        <input type="submit" class="btn btn-success" name="generate" value="Generate Document">
    </div>
    </form>
</div>

