<?php
session_start();
include('../../../phpfiles/connection.php');
if(isset($_POST['blotter_id'])){
    $blotID = $_POST['blotter_id'];

    $query1 = "UPDATE blotter_table set status = 'cancelled' WHERE blotter_ID = '$blotID';";
    $result1 = $conn -> query($query1);

    $_SESSION['cancelBlot'] = "Your blotter has been cancelled.";
}
header('location:view_blotters.php');

?>