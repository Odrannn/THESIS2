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


$document_Type = $_POST["suggfreq"];

//get chairman 
$query2 = "SELECT name FROM tblofficial WHERE position = 'Chairman';";
$result2 = $conn -> query($query2);
$row2 = $result2 -> fetch_assoc();
$chname = strtoupper($row2['name']);


date_default_timezone_set('Asia/Manila'); // SET TIMEZONE
$day = date("j");
$week = date("W");
$month = strtoupper(date("F"));
$year = date("Y");
$full_date = date("M j, Y");
$currentDate = date("Y-m-d");

//"SELECT * FROM member WHERE date(date_submit) BETWEEN '$date1' AND '$date2'")



if($document_Type == 'DAILY')
{
	$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed' AND suggestion_date = '$currentDate';";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$noticed = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending' AND suggestion_date = '$currentDate';";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $noticed;




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
				<h1>DAILY SUGGESTION REPORT <BR> $currentDate </h1>
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
			</body>
			</html>";
		
		
		
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

			
			$query10 = "SELECT * FROM suggestion_table WHERE suggestion_date = '$currentDate';";
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

    $dompdf->addInfo("Title", "DAILYSUGGESTREPORT");

    $dompdf->stream("DAILYSUGGESTREPORT.pdf", ["Attachment" => 0]);



}

if($document_Type == 'WEEKLY')
{
//count solved
$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed' AND WEEK(suggestion_date) = WEEK(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$noticed = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending' AND WEEK(suggestion_date) = WEEK(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $noticed;




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
				<h1>WEEKLY SUGGEST REPORT - WEEK $week</h1>
				<table class='table table-bordered' align='center' width='100%'>
				  <thead>
					<tr>
					  <th colspan='2'>OVERALL </th>
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
			</body>
			</html>";
		
		
		
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

			
			$query10 = "SELECT * FROM suggestion_table WHERE week(suggestion_date) = week(now());";
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

    $dompdf->addInfo("Title", "WEEKLYSUGGESTREPORT");

    $dompdf->stream("WEEKLYSUGGESTREPORT.pdf", ["Attachment" => 0]);
}

if($document_Type == 'MONTHLY')
{
//count solved
$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed' AND MONTH(suggestion_date) = MONTH(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$noticed = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending' AND MONTH(suggestion_date) = MONTH(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $noticed;




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
				<h1>MONTHLY SUGGESTION REPORT - $month</h1>
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
	
				
				$query10 = "SELECT * FROM suggestion_table WHERE month(suggestion_date) = month(now());";
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

    $dompdf->addInfo("Title", "MONTHLYSUGGESTREPORT");

    $dompdf->stream("MONTHLYSUGGESTREPORT.pdf", ["Attachment" => 0]);
}

if($document_Type == 'YEARLY')
{
//count solved
$comp_query1 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'noticed' AND YEAR(suggestion_date) = YEAR(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$noticed = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(sender_ID) FROM suggestion_table WHERE suggestion_status = 'pending' AND YEAR(suggestion_date) = YEAR(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $noticed;


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
				<h1>YEARLY SUGGESTION REPORT - $year</h1>
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
			</body>
			</html>";
		
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

			
			$query10 = "SELECT * FROM suggestion_table WHERE YEAR(suggestion_date) = YEAR(now());";
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

    $dompdf->addInfo("Title", "YEARLYSUGGESTREPORT");

    $dompdf->stream("YEARLYSUGGESTREPORT.pdf", ["Attachment" => 0]);
}

if($document_Type == 'ALL')
{
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
	
	
		
	




	$options = new Options;
    $options -> setChroot(__DIR__);

    $dompdf = new Dompdf($options);

    //$dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "OVERALLSUGGESTREPORT");

    $dompdf->stream("OVERALLSUGGESTREPORT.pdf", ["Attachment" => 0]);

}


?>
