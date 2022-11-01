<?php
session_start();
include("../../phpfiles/connection.php");

if(isset($_POST['edit_ann'])){
    $annID = $_POST['ann_id'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];

    $result = $conn -> query("UPDATE announcement SET title = '$title', descrip = '$desc', status='$status' WHERE id = '$annID'");

    if($result){
        $_SESSION['message'] = 'Announcement successfully updated.';
        $_SESSION['status'] = '1';
    } else {
        $_SESSION['message'] = 'Invalid.';
        $_SESSION['status'] = '0';
    }
    header("location:announcement.php");
}
?>