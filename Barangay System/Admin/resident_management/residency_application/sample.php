<?php

function itexmo($number,$message,$apicode){
    $ch = curl_init();
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
    curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query($itexmo));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec ($ch);
    curl_close ($ch);
}

include("../../../phpfiles/connection.php");
$uinfoquery = "SELECT * FROM tbluser WHERE id = '8';";
$uinforesult = $conn -> query($uinfoquery); 
$uinforow = mysqli_fetch_array($uinforesult);

$username = $uinforow['username'];
$password = $uinforow['password'];
$number = "09616064483";
$apicode = "TR-BERNA585777_2UGZT";
$message = "Username: " . $username . " Password: " . $password;

//echo $number;
//echo $message;
//echo $apicode;

$result = itexmo($number, "Hello World", $apicode);

if($result == "")
{
    echo "no response";
}
else if($result == 0)
{
    echo "Message Sent!";
}
else 
{
    echo "Error " . $result;
}















?>