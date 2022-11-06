<?php
include("../../phpfiles/connection.php");
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";

//get barangay info
include("../../phpfiles/bgy_info.php");
$bgyname = $row['bgy_name'];
$bgycity = $row['city'];
$logo = $row['logo_url'];

$date1 = $_POST["date1"];
$newDate1 = date("Y-m-d", strtotime($date1));  
$date2 = $_POST["date2"];
$newDate2 = date("Y-m-d", strtotime($date2));  

$document_Type = $_POST["type"];

//get chairman 
$query2 = "SELECT name FROM tblofficial WHERE position = 'Chairman';";
$result2 = $conn -> query($query2);
$row2 = $result2 -> fetch_assoc();
$chname = strtoupper($row2['name']);



$day = date("j");
$month = date("F");
$year = date("Y");
$full_date = date("M j, Y");


//"SELECT * FROM member WHERE date(date_submit) BETWEEN '$date1' AND '$date2'")



if($document_Type == 'Complaint')
{
	$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved' and (date(complaint_date) BETWEEN '$date1' AND '$date2')";
	$comp_result1 = $conn -> query($comp_query1);
	$comp_row1 = $comp_result1 -> fetch_array();
	$solved = $comp_row1[0];
	//count pending                    
	$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending' and (date(complaint_date) BETWEEN '$date1' AND '$date2')";
	$comp_result2 = $conn -> query($comp_query2);
	$comp_row2 = $comp_result2 -> fetch_array();
	$pending = $comp_row2[0];
	$total = $pending + $solved;
	
	
 $html = "
    <div style='text-align: center;'>
    Republic of the Philippines<br>
    City of $bgycity<br>
    <h1>Barangay $bgyname</h1>
    </div>";
    
    $html .= '<hr style="margin: 0 40px;">';
    
    $html .= "<br>
    <div style='text-align: center;'>
    <h3>OFFICE OF THE BARANGAY CAPTAIN</h3>
    <h1>BARANGAY COMPLAINT REPORT</h1>
	<H3>FROM $date1 TO $date2 </H3>
    </div>
    <br><br>
    
    ";
	
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
	";
	
	
	
	$html .="
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL COMPLAINT </th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>PENDING</td>
					  <td>$pending</td>
					</tr>
					<tr>
					  <td>SOLVED</td>
					  <td>$solved</td>
					</tr>
				  </tbody>
				  <tfoot>
					<tr>
					  <td>TOTAL</td>
					  <td>$total</td>
					</tr>
				  </tfoot>
				</TABLE>
				<br>";
				
$html .="
				<table class='table table-bordered' align='center' width='100%'>
				<thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Official in Charge</th>
                            <th>Sender ID</th>
                            <th>Nature</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
				
				";

				
				$query10 = "SELECT * FROM complaint_table WHERE (date(complaint_date) BETWEEN '$date1' AND '$date2')";
				$result10 = $conn -> query($query10);
				
				while($row10 = $result10->fetch_assoc()){
					$complaint_ID = $row10['complaint_ID'];
					$sender_ID = $row10['sender_ID'];
					$official_ID = $row10['official_ID'];
					$nature = $row10['complaint_nature'];
					$desc = $row10['comp_desc'];
					$date = $row10['complaint_date'];
					$status = $row10['complaint_status'];
				$html .="
						<tr>
                            <td>$complaint_ID</td>
                            <td>$official_ID</td>
                            <td>$sender_ID</td>
                            <td>$nature</td>
                            <td>$desc</td>
                            <td>$date</td>
                            <td>$status</td>
                        </tr>";
						}
				
				$html .="
					</tbody>
				</table>
			</body>
			</html>";

    

    $options = new Options;
    $options -> setChroot(__DIR__);

    $dompdf = new Dompdf($options);

    //$dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "Barangay Clearance");

    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);

}
if($document_Type == 'Suggest')
{
	//count solved
	$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed' and(date(suggestion_date) BETWEEN '$date1' AND '$date2')";
	$comp_result1 = $conn -> query($comp_query1);
	$comp_row1 = $comp_result1 -> fetch_array();
	$noticed = $comp_row1[0];
	//count pending                    
	$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending' and(date(suggestion_date) BETWEEN '$date1' AND '$date2')";
	$comp_result2 = $conn -> query($comp_query2);
	$comp_row2 = $comp_result2 -> fetch_array();
	$pending = $comp_row2[0];
	$total = $pending + $noticed;
	
	
    $html = "
    <div style='text-align: center;'>
    Republic of the Philippines<br>
    City of $bgycity<br>
    <h1>Barangay $bgyname</h1>
    </div>";
    
    $html .= '<hr style="margin: 0 40px;">';
    
    $html .= "<br>
    <div style='text-align: center;'>
    <h3>OFFICE OF THE BARANGAY CAPTAIN</h3>
    <h1>BARANGAY SUGGESTION REPORT</h1>
	<H3>FROM $date1 TO $date2 </H3>
    </div>
    
    ";
	
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
	";
	
	
	
	$html .= "<table class='table table-bordered' align='center' width='100%'>
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

				
				$query10 = "SELECT * FROM suggestion_table where (date(suggestion_date) BETWEEN '$date1' AND '$date2')";
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
    

    
    $options = new Options;
    $options -> setChroot(__DIR__);
    
    $dompdf = new Dompdf($options);
    
    //$dompdf->setPaper("A4", "Landscape");
    
    $dompdf->loadHtml($html);
    
    $dompdf->render();
    
    $dompdf->addInfo("Title", "Barangay Clearance");
    
    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);


}

if($document_Type == 'Blotter')
{
	//COUNT UNSCHEDULED   
	$comp_query1 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'unscheduled' and (date(blotter_date) BETWEEN '$date1' AND '$date2')";
	$comp_result1 = $conn -> query($comp_query1);
	$comp_row1 = $comp_result1 -> fetch_array();
	$unscheduled = $comp_row1[0];          
	//COUNT UNSETTLED        
	$comp_query2 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'unsettled' and (date(blotter_date) BETWEEN '$date1' AND '$date2')";
	$comp_result2 = $conn -> query($comp_query2);
	$comp_row2 = $comp_result2 -> fetch_array();
	$unsettled = $comp_row2[0]; 
	//COUNT SCHEDULED            
	$comp_query3 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'scheduled' and (date(blotter_date) BETWEEN '$date1' AND '$date2')";
	$comp_result3 = $conn -> query($comp_query3);
	$comp_row3 = $comp_result3 -> fetch_array();
	$scheduled = $comp_row3[0];   
	//COUNT SETTLED            
	$comp_query4 = "SELECT COUNT(complainant_ID) FROM blotter_table WHERE status = 'settled' and (date(blotter_date) BETWEEN '$date1' AND '$date2')";
	$comp_result4 = $conn -> query($comp_query4);
	$comp_row4 = $comp_result4 -> fetch_array();
	$settled = $comp_row4[0];
	
	
    
    $html = "
    <div style='text-align: center;'>
    Republic of the Philippines<br>
    City of $bgycity<br>
    <h1>Barangay $bgyname</h1>
    </div>";
    
    $html .= '<hr style="margin: 0 40px;">';
    
    $html .= "<br>
    <div style='text-align: center;'>
    <h3>OFFICE OF THE BARANGAY CAPTAIN</h3>
    <h1>BARANGAY BLOTTER REPORT</h1>
	<H3>FROM $date1 TO DATE $date2 </H3>
    </div>
    
    ";
	
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
	";
	
	
	
	$html .= "<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL BLOTTER</th>
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
				<BR>
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

				$query10 = "SELECT * FROM blotter_table WHERE (date(blotter_date) BETWEEN '$date1' AND '$date2')";
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
			</body>";
    
    
    $options = new Options;
    $options -> setChroot(__DIR__);
    
    $dompdf = new Dompdf($options);
    
    $dompdf->setPaper("A4", "Landscape");
    
    $dompdf->loadHtml($html);
    
    $dompdf->render();
    
    $dompdf->addInfo("Title", "Barangay Clearance");
    
    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);
}
?>
