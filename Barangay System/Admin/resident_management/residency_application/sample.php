<?php
/*include("../../../phpfiles/connection.php");
$uinfoquery = "SELECT * FROM tbluser WHERE id = '8';";
$uinforesult = $conn -> query($uinfoquery); 
$uinforow = mysqli_fetch_array($uinforesult);

$username = $uinforow['username'];
$password = $uinforow['password'];*/

/*function itexmo($number, $message, $apicode, $passwd)
{
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}

function itexmo($email, $number, $message, $apicode, $passwd)
{
    $url = 'https://api.itexmo.com/api/broadcast';
    $itexmo = array('Email' =>$email, 'ApiCode' => $apicode, 'Password' => "Mazo20181132826", 'Numbers' => $number, 'Message' => $message);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}


*/
//echo $number;
//echo $message;
//echo $apicode;

function itexmo($email,$password,$number,$message,$apicode)
{
    $ch = curl_init();
    $recipient = array();
    array_push($recipient, $number);
    $itexmo = array('Email' => $email,  'Password' => $password, 'ApiCode' => $apicode, 'Recipients' => $recipient, 'Message' => $message);
    curl_setopt($ch, CURLOPT_URL,"https://api.itexmo.com/api/broadcast");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($itexmo));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec ($ch);
    curl_close ($ch);
}


$email = "orsolino.christianphilip@ue.edu.ph";
$password = "Yahoocom12";
$apicode = "TR-CHRIS339758_OWHXS";
$number = '09095307513';
$message = "Registration Accepted.\n ACCOUNT DETAILS \nUsername: ". $number . " \nPassword: 12345678";

echo itexmo($email, $password, $number, $message, $apicode);

?>