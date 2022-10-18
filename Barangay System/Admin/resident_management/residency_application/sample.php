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
}*/
//echo $number;
//echo $message;
//echo $apicode;

function itexmo()
{
    $number = '09616064483';
    $apicode = 'PR-BERNA461967_SZ8D9';
    $message = 'Hello';
    $passwd = 'Mazo20181132826';

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


$result = itexmo();

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
    echo "Error " . $result . " Encountered!";
}
?>