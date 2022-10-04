<?php
include("../phpfiles/connection.php");

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$requestID = $_POST["id"];
$senderID = $_POST["senderid"];

//get sender info
$query1 = "SELECT * FROM resident_table WHERE id = '$senderID';";
$result1 = $conn -> query($query1);
$row1 = $result1->fetch_assoc();
$senderName = $row1['fname'] . " " . $row1['mname'] . " " . $row1['lname'];
$surname = $row1['lname'];
$age = $row1['age'];
$nationality = $row1['nationality'];

//get barangay info
include("../phpfiles/bgy_info.php");
$bgyname = $row['bgy_name'];
$bgycity = $row['city'];
$logo = $row['logo_url'];

//get chairman 
$query2 = "SELECT name FROM tblofficial WHERE position = 'Chairman';";
$result2 = $conn -> query($query2);
$row2 = $result2->fetch_assoc();
$chname = strtoupper($row2['name']);

$day = date("j");
$month = date("F");
$year = date("Y");

$full_date = date("M j, Y");

$html = "
<img src='logo.jpg' width='100' style='position:fixed; left:50px;'> 
<div style='text-align: center;'>
Republic of the Philippines<br>
City of $bgycity<br>
<h1>Barangay $bgyname</h1>
</div>";

$html .= '<hr style="margin: 0 40px;">';

$html .= "<br>
<div style='text-align: center;'>
<h3>OFFICE OF THE BARANGAY CAPTAIN</h3>
<h1>BARANGAY CLEARANCE</h1>
</div>
<br><br>
<div style='margin: 0 40px; line-height:200%; text-align: justify;'>
    <b>TO WHOM IT MAY CONCERN:</b>
    <p style='text-indent: 50px;'>
    This is to certify that $senderName, $age years old, $nationality and a resident of
    Barangay $bgyname, $bgycity is known to be of good moral character and law-abiding citizen in the
    community.
    </p>
    <p style='text-indent: 50px;'>
    To certify further, that he/she has no derogatory and/or criminal records filed in this barangay.
    </p>
    <p style='text-indent: 50px;'>
    <b>ISSUED</b> this $day of $month, $year at Barangay $bgyname, $bgycity upon request of the interested party
    for whatever legal purposes it may serve.
    </p>
</div>
<br><br><br>
";

$html .= "
<div style='margin: 0 40px;'>
    <div style='width:27%;float:right;'>
        <p><b>$chname</b><br>Barangay Captain</p>
    </div>
</div>
<br><br><br><br><br><br><br>
<div style='margin: 0 40px;'>
    O.R. No. $requestID <br>
    Date Issued: $full_date<br>
    Doc. Stamp: paid
</div>
";

$options = new Options;
$options -> setChroot(__DIR__);

$dompdf = new Dompdf($options);

//$dompdf->setPaper("A4", "Landscape");

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->addInfo("Title", "Barangay Clearance");

$dompdf->stream("$surname-BarangayClearance.pdf", ["Attachment" => 0]);
?>