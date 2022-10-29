<?php
$number = '09616064483';
$apicode = 'PR-BERNA461967_SZ8D9';
$message = 'Hello';
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit You do not have permission to view the full content of this post. Log in or register now. for more info about this API
//##########################################################################
function itexmo($number, $message, $apicode)
    {
        $ch = curl_init();
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
        curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
        curl_close($ch);
    }
//##########################################################################
$result = itexmo("09616064483","Hello","PR-BERNA461967_SZ8D9");

if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.
Please CONTACT US for help. ";
}else if ($result == 0){
echo "Message Sent!";
}
else{
echo "Error Num ". $result . " was encountered!";
}
?>