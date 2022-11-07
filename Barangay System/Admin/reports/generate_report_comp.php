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


$document_Type = $_POST["compfreq"];

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


//"SELECT * FROM member WHERE date(date_submit) BETWEEN '$date1' AND '$date2'")



if($document_Type == 'DAILY')
{
$currentDate = date("Y-m-d");
//count solved
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved' AND complaint_date = '$currentDate';";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$solved = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending' AND complaint_date = '$currentDate';";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $solved;

	
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
				<h1>DAILY COMPLAINT REPORT  <BR> $currentDate</h1>
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
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
				  
				";
				$query9 = "SELECT DISTINCT complaint_nature FROM complaint_table;";
				$result9 = $conn -> query($query9);
				while($row9 = $result9->fetch_array()){
					$nature = $row9["complaint_nature"];
					$query10 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature='$nature' AND complaint_date = '$currentDate';";
					$result10 = $conn -> query($query10);
					$row10 = $result10 -> fetch_array();
					$natureCount = $row10[0];
						//$cnature = $row10["complaint_nature"]; 
					$nature = strtoupper($nature);
					
					echo $row10[0];
		$html .="		
					<tr>
					  <td>$nature</td>
					  ";		
					//}
		$html .="
					  <td>$natureCount</td>
					</tr>
				";
				}
					
		$html .="
				  </tbody>
				</table>
				<br>
				";
				
				//NEXT TABLE
			
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
				
				$query10 = "SELECT * FROM complaint_table WHERE complaint_date = '$currentDate';";
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

    $dompdf->stream("DAILYCOMPLAINTREPORT.pdf", ["Attachment" => 0]);

	
}
if($document_Type == 'WEEKLY')
{
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved' AND WEEK(complaint_date) = WEEK(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$solved = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending' AND WEEK(complaint_date) = WEEK(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $solved;


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
				<h1>WEEKLY COMPLAINT REPORT - WEEK $week</h1>
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
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
				  
				";
				$query9 = "SELECT DISTINCT complaint_nature FROM complaint_table;";
				$result9 = $conn -> query($query9);
				while($row9 = $result9->fetch_array()){
					$nature = $row9["complaint_nature"];
					$query10 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature='$nature' AND WEEK(complaint_date) = WEEK(now());";
					$result10 = $conn -> query($query10);
					$row10 = $result10 -> fetch_array();
					$natureCount = $row10[0];
						//$cnature = $row10["complaint_nature"]; 
					$nature = strtoupper($nature);
					
					echo $row10[0];
		$html .="		
					<tr>
					  <td>$nature</td>
					  ";		
					//}
		$html .="
					  <td>$natureCount</td>
					</tr>
				";
				}
					
		$html .="
				  </tbody>
				</table>
				<br>
				";
		
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
				
				$query10 = "SELECT * FROM complaint_table WHERE WEEK(complaint_date) = WEEK(now());";
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

    $dompdf->stream("WEEKLYCOMPLAINTREPORT.pdf", ["Attachment" => 0]);
	
}

if($document_Type == 'MONTHLY')
{
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved' AND MONTH(complaint_date) = MONTH(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$solved = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending' AND MONTH(complaint_date) = MONTH(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $solved;


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
				<h1>MONTHLY COMPLAINT REPORT - $month</h1>
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
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
				  
				";
				$query9 = "SELECT DISTINCT complaint_nature FROM complaint_table;";
				$result9 = $conn -> query($query9);
				while($row9 = $result9->fetch_array()){
					$nature = $row9["complaint_nature"];
					$query10 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature='$nature' AND MONTH(complaint_date) = MONTH(now());";
					$result10 = $conn -> query($query10);
					$row10 = $result10 -> fetch_array();
					$natureCount = $row10[0];
						//$cnature = $row10["complaint_nature"]; 
					$nature = strtoupper($nature);
					
					echo $row10[0];
		$html .="		
					<tr>
					  <td>$nature</td>
					  ";		
					//}
		$html .="
					  <td>$natureCount</td>
					</tr>
				";
				}
					
		$html .="
				  </tbody>
				</table>
				<br>
				";
		
		
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

				
				$query10 = "SELECT * FROM complaint_table WHERE month(complaint_date) = month(now());";
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

    $dompdf->stream("MONTHLYCOMPLAINTREPORT.pdf", ["Attachment" => 0]);
	
	


}

if($document_Type == 'YEARLY')
{
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved' AND YEAR(complaint_date) = YEAR(now());";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$solved = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending' AND YEAR(complaint_date) = YEAR(now());";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $solved;




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
				<h1>YEARLY COMPLAINT REPORT - $year</h1>
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
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
				  
				";
				$query9 = "SELECT DISTINCT complaint_nature FROM complaint_table;";
				$result9 = $conn -> query($query9);
				while($row9 = $result9->fetch_array()){
					$nature = $row9["complaint_nature"];
					$query10 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature='$nature' AND year(complaint_date) = year(now());";
					$result10 = $conn -> query($query10);
					$row10 = $result10 -> fetch_array();
					$natureCount = $row10[0];
						//$cnature = $row10["complaint_nature"]; 
					$nature = strtoupper($nature);
					
					echo $row10[0];
		$html .="		
					<tr>
					  <td>$nature</td>
					  ";		
					//}
		$html .="
					  <td>$natureCount</td>
					</tr>
				";
				}
					
		$html .="
				  </tbody>
				</table>
				<br>
				";
		
		
		
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

				
				$query10 = "SELECT * FROM complaint_table WHERE YEAR(complaint_date) = YEAR(now());";
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

    $dompdf->stream("YEARLYCOMPLAINTREPORT.pdf", ["Attachment" => 0]);
	

}

if($document_Type == 'ALL')
{
	//count solved
$comp_query1 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'solved';";
$comp_result1 = $conn -> query($comp_query1);
$comp_row1 = $comp_result1 -> fetch_array();
$solved = $comp_row1[0];
//count pending                    
$comp_query2 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_status = 'pending';";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$pending = $comp_row2[0];
$total = $pending + $solved;


	


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
				<h1>OVERALL COMPLAINT REPORT</h1>
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
					  <th colspan='2'>NATURE OF COMPLAINT</th>
					</tr>
				  </thead>
				  <tbody>
				  
				";
				$query9 = "SELECT DISTINCT complaint_nature FROM complaint_table;";
				$result9 = $conn -> query($query9);
				while($row9 = $result9->fetch_array()){
					$nature = $row9["complaint_nature"];
					$query10 = "SELECT COUNT(complaint_ID) FROM complaint_table WHERE complaint_nature='$nature'";
					$result10 = $conn -> query($query10);
					$row10 = $result10 -> fetch_array();
					$natureCount = $row10[0];
						//$cnature = $row10["complaint_nature"]; 
					$nature = strtoupper($nature);
					
					echo $row10[0];
		$html .="		
					<tr>
					  <td>$nature</td>
					  ";		
					//}
		$html .="
					  <td>$natureCount</td>
					</tr>
				";
				}
					
		$html .="
				  </tbody>
				</table>
				<br>
				";				

			

				
				
				
				
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

				
				$query10 = "SELECT * FROM complaint_table;";
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

    $dompdf->stream("ALLCOMPLAINTREPORT.pdf", ["Attachment" => 0]);

}


   
?>
