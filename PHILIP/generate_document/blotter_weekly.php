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
$week = date("W");
$year = date("Y");
$full_date = date("M j, Y");


//count solved
$comp_query1 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'settled' AND WEEK(blotter_date) = WEEK(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$settled = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'unsettled' AND WEEK(blotter_date) = WEEK(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$unsettled = $comp_row2[0];

//count nature[1]                   
$comp_query3 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'scheduled' AND WEEK(blotter_date) = WEEK(now());";
$comp_result3 = $conn -> query($comp_query3);
$comp_row3 = $comp_result3 -> fetch_array();
$scheduled = $comp_row3[0];

//count nature[2]                   
$comp_query4 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'unscheduled' AND WEEK(blotter_date) = WEEK(now());";
$comp_result4 = $conn -> query($comp_query4);
$comp_row4 = $comp_result4 -> fetch_array();
$unscheduled = $comp_row4[0];





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
					border-collapse: collapse;
				  }
				</style>
			</head>
			<body>	
				<h1>WEEKLY BLOTTER REPORT - WEEK $week</h1>
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>SETTLED</td>
					  <td>$settled</td>
					</tr>
					<tr>
					  <td>UNSETTLED</td>
					  <td>$unsettled</td>
					</tr>
				  </tbody>
				  <tfoot>
					<tr>
					  <td>SCHEDULED</td>
					  <td>$scheduled</td>
					</tr>
					<tr>
					  <td>UNSCHEDULED</td>
					  <td>$unscheduled</td>
					</tr>
				  </tfoot>
				</table>
				<br>
				";

			




			
				$html .="
				<table class='table table-bordered' align='center' width='100%'>
				<thead>
                        <tr>
                            <th>Blotter ID</th>
                            <th>Official ID</th>
                            <th>Complainant ID</th>
                            <th>Complainee ID</th>
                            <th>Complainee Name</th>
                            <th>Date</th>
                            <th>Accusation</th>
							<th>Details</th>
							<th>Settlement Schedule</th>
							<th>Status</th>
                        </tr>
                    </thead>
				
				";

				$query10 = "SELECT * FROM blotter_table WHERE week(blotter_date) = week(now());";
				$result10 = $conn -> query($query10);
				
				while($row10 = $result10->fetch_assoc()){
					$blotter_ID = $row10['blotter_ID'];
					$official_ID = $row10['official_ID'];
					$complainant_ID = $row10['complainant_ID'];
					$complainee_ID = $row10['complainee_ID'];
					$complainee_name = $row10['complainee_name'];
					$date = $row10['blotter_date'];
					$time = $row10['blotter_time'];
					//$time = $row10['blotter_time]']date("h:iA");
					$accusation = $row10['blotter_accusation'];
					$details = $row10['blotter_details'];
					$settlement_schedule = $row10['settlement_schedule'];
					$settlement_time = $row10['settlement_time'];					
					$status = $row10['status'];
				$html .="
						<tr>
                            <td>$blotter_ID</td>
                            <td>$official_ID</td>
                            <td>$complainant_ID</td>
                            <td>$complainee_ID</td>
                            <td>$complainee_name</td>
                            <td>$date, $time</td>
							<td>$accusation</td>
							<td>$details</td>
							<td>$settlement_schedule, $settlement_time</td>
							<td>$status</td>

                        </tr>";
						}
				
				$html .="
					</tbody>
				</table>
			</body>
			</html>";
	
	
	


    $dompdf = new Dompdf();

    $dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "Barangay Clearance");

    $dompdf->stream("$week-WEEKYBLOTTERREPORT.pdf", ["Attachment" => 0]);
?>