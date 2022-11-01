<?php
include("../phpfiles/connection.php");
require 'dompdf/autoload.inc.php';

$requestID = $_POST["id"];
$officialID = $_POST["officialid"];
$senderID = $_POST["senderid"];
$documentID = $_POST["documentid"];

//get sender info
$query1 = "SELECT * FROM resident_table WHERE id = '$senderID';";
$result1 = $conn -> query($query1);
$row1 = $result1->fetch_assoc();
$senderName = $row1['fname'] . " " . $row1['mname'] . " " . $row1['lname'];
$surname = $row1['lname'];

$dateOfBirth = $row1["birthday"];
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$age = $diff->format('%y');
$civstatus = $row1['civilstatus'];
$nationality = $row1['nationality'];

//get barangay info
include("../phpfiles/bgy_info.php");
$bgyname = $row['bgy_name'];
$bgycity = $row['city'];
$logo = $row['logo_url'];

//get chairman 
$query2 = "SELECT name FROM tblofficial WHERE position = 'Chairman';";
$result2 = $conn -> query($query2);
$row2 = $result2 -> fetch_assoc();
$chname = strtoupper($row2['name']);

//get document info
$query3 = "SELECT document_type FROM document_type WHERE id = '$documentID';";
$result3 = $conn -> query($query3);
$row3 = $result3->fetch_assoc();
$document_Type = $row3['document_type'];

$day = date("j");
$month = date("F");
$year = date("Y");
$full_date = date("M j, Y");

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html = "
    <img src='logo.jpg' width='100' style='position:fixed; left:50px;'> ";
ob_start();
require('details_pdf.php');
$html .= ob_get_contents();
ob_get_clean();



$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('generate-document.pdf', ['Attachment'=>false]);
?>