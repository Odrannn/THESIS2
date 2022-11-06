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


//count solved
$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed';";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$noticed = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending';";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $noticed;

//count nature[1]                   
$comp_query3 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature = 'Dirty Barangay';";
$comp_result3 = $conn -> query($comp_query3);
$comp_row3 = $comp_result3 -> fetch_array();
$dirty = $comp_row3[0];

//count nature[2]                   
$comp_query4 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature = 'Drugs';";
$comp_result4 = $conn -> query($comp_query4);
$comp_row4 = $comp_result4 -> fetch_array();
$drugs = $comp_row4[0];

//count nature[3]                   
$comp_query5 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature = 'Gossip Mongers';";
$comp_result5 = $conn -> query($comp_query5);
$comp_row5 = $comp_result5 -> fetch_array();
$gossip = $comp_row5[0];

//count nature[4]                   
$comp_query6 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature = 'Noise';";
$comp_result6 = $conn -> query($comp_query6);
$comp_row6 = $comp_result6 -> fetch_array();
$noise = $comp_row6[0];

//count nature[1]                   
$comp_query7 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature = 'Other';";
$comp_result7 = $conn -> query($comp_query7);
$comp_row7 = $comp_result7 -> fetch_array();
$other = $comp_row7[0];

	



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
			
				table,  td {
				border: 1px solid black;
				}
				</style>
			</head>
			<body>	
				<h1>OVERALL SUGGEST REPORT</h1>
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>NOTICED</td>
					  <td>$noticed</td>
					</tr>
					<tr>
					  <td>PENDING</td>
					  <td>$pending</td>
					</tr>
				  </tbody>
				  <tfoot>
					<tr>
					  <td>TOTAL</td>
					  <td>$total</td>
					</tr>
					
				  </tfoot>
				</table>
			  <br>
			  ";
		
		
		$html .="
				<table class='table table-bordered' align='center' width='100%'>
				<thead>
                        <tr>
                            <th>Suggestion ID</th>
							<th>Sender ID</th>
                            <th>Official in Charge</th>
                            <th>Nature</th>
                            <th>Description</th>
                            <th>Date</th>
							<th>Feedback</th>
                            <th>Status</th>
                        </tr>
                    </thead>
				
				";

				
				$query10 = "SELECT * FROM suggestion_table;";
				$result10 = $conn -> query($query10);
				
				while($row10 = $result10->fetch_assoc()){
					$suggestion_ID = $row10['suggestion_ID'];
					$sender_ID = $row10['sender_ID'];
					$official_ID = $row10['official_ID'];
					$nature = $row10['suggestion_nature'];
					$desc = $row10['suggestion_desc'];
					$date = $row10['suggestion_date'];
					$feedback = $row10['suggestion_feedback'];
					$status = $row10['suggestion_status'];
				$html .="
						<tr>
                            <td>$suggestion_ID</td>
                            <td>$sender_ID</td>
                            <td>$official_ID</td>
                            <td>$nature</td>
                            <td>$desc</td>
                            <td>$date</td>
							<td>$feedback</td>
                            <td>$status</td>
                        </tr>";
						}
				
				$html .="
					</tbody>
				</table>
			</body>
			</html>";
	
	
	


    $dompdf = new Dompdf();

    //$dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "Barangay Clearance");

    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);
?>