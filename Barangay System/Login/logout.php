<?php
session_start();
$_SESSION['user_id'] = '';
$_SESSION['message'] = '';
header("location:login.php");
?>