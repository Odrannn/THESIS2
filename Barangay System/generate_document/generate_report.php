<?php
include("../phpfiles/connection.php");
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";

//get barangay info
include("../phpfiles/bgy_info.php");
$bgyname = $row['bgy_name'];
$bgycity = $row['city'];
$logo = $row[2];

//get chairman 
$query2 = "SELECT name FROM tblofficial WHERE position = 'Chairman';";
$result2 = $conn -> query($query2);
$row2 = $result2 -> fetch_assoc();
$chname = strtoupper($row2['name']);


$day = date("j");
$month = date("F");
$year = date("Y");
$full_date = date("M j, Y");

//count total
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table;";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$total = $comp_row1[0];



    $html = "
    <img src='' width='100' style='position:fixed; left:50px;'> 
    <div style='text-align: center;'>
    Republic of the Philippines<br>
    City of $bgycity<br>
    <h1>Barangay $bgyname</h1>
    </div>";

    $html .= '<hr style="margin: 0 40px;">';

	
	$html .="
			<!DOCTYPE html>
			<html lang='en'>
			<head>
				<meta charset='UTF-8'>
				<title>Generate HTML to PDF</title>
				<style>
				*{text-align:center;}
			
				table, th, td {
				border: 1px solid black;
				}
				</style>
			</head>
			<body>	
				<h1>BARANGAY COMPLAINT REPORT</h1>
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL COMPLAINT </th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>PENDING</td>
					  <td></td>
					</tr>
					<tr>
					  <td>SOLVED</td>
					  <td></td>
					</tr>
				  </tbody>
				  <tfoot>
					<tr>
					  <td>TOTAL</td>
					  <td>$total</td>
					</tr>
				  </tfoot>
				</TABLE>
				
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>DIRTY BARANGAY</td>
					  <td></td>
					</tr>
					<tr>
					  <td>DRUGS</td>
					  <td></td>
					</tr>
					<tr>
					  <td>GOSSIP</td>
					  <td></td>
					</tr>
					<tr>
					  <td>NOISE</td>
					  <td></td>
					</tr>
				  </tbody>
				</table>
				<BR><BR>
			</body>
			</html>";
	
	
	


    $dompdf = new Dompdf();

    //$dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "Barangay Clearance");

    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);
?>