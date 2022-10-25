<?php
include('../../phpfiles/connection.php');
if(isset($_POST['reqid'])){?>
    <form action="submit_payment.php" method="post" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
            <div class="container">
                <?php
                    $query1 = "SELECT * FROM payment_info;";
                    $result1 = $conn -> query($query1);
                    $row1 = $result1->fetch_assoc();
                ?>
                <h5>Payment Information</h5>
                <b>Method:</b> Gcash <br>
                <b>Gcash Number:</b> <?php echo $row1['cp_number'];?> <br>
                <b>Gcash Name:</b> <?php echo $row1['g_name'];?> <br>

                <b>Note:</b> Take a screenshot of your payment and attach the image to the 'Proof of Payment' input field below. Once you click 'submit', you won't be able to cancel your request.
                <div class="row">
                    <div class="col-md pt-2">
                        <label class="pb-2" for="proof"><b>Proof of Payment</b></label> 
                        <input class="form-control" type="file" id="proof" name="proof" required></td>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            
                <input type="hidden" name="req_id" value="<?php echo $_POST['reqid'] ?>">
                <input type="submit" class="btn btn-primary" name="payment" value="Submit">
            
        </div>
    </div>
    </form>
    <?php
}
?>
