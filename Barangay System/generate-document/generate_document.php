<?php
include("../phpfiles/connection.php");
require_once 'phpqrcode/qrlib.php';
date_default_timezone_set('Asia/Manila'); // SET TIMEZONE

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

//create Qr
$qrtext = 'Request ID: ' . $requestID . "\n". 
        'Full Name:' . $senderName . "\n".
        'Date Issued: ' . $full_date;
$path = 'qr_images/';
$qrcode = $path. $surname . "-REQUEST-" . $requestID . ".png";
QRcode::png($qrtext,$qrcode);
//$queryQR = "INSERT INTO document_request(qr_image) VALUES($qrcode);";
//$resultQR = $conn -> query($queryQR);

require_once('tcpdf/tcpdf.php');  
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR);  
$pdf->SetTitle("Generate Document");  
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
$pdf->SetDefaultMonospacedFont('helvetica');  
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
$pdf->setPrintHeader(false);  
$pdf->setPrintFooter(false);  
$pdf->SetAutoPageBreak(TRUE, 10);  
$pdf->SetFont('times', '', 12);  
$pdf->AddPage();  

$pdf->writeHTML('<br>', true, false, true, false, '');  
$pdf->cell(185, 0, 'Republic of the Philippines', 0,1,'C');  
$pdf->cell(185, 0, "City of $bgycity", 0,1,'C');  
$pdf->SetFont('times', '', 30); 
$pdf->cell(185, 0, "Barangay $bgyname", 0,1,'C');  
$pdf->SetFont('times', '', 24); 
$pdf->cell(0, 0, "__________________________________________", 0,1,'C');  
$pdf->SetFont('times', 'B', 16); 
$pdf->writeHTML('<br>', true, false, true, false, '');  
$pdf->cell(0, 0, "OFFICE OF THE BARANGAY CAPTAIN", 0,1,'C');  

if($document_Type == 'Certificate of Indigency')
{
    $pdf->SetFont('times', '', 24); 
    $pdf->writeHTML('<br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "CERTIFICATE OF INDIGENCY", 0,1,'C');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->writeHTML('<br><br><br><br><br><br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "TO WHOM IT MAY CONCERN:", 0,1,'L');  
    $pdf->writeHTML('<br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', '', 12);
    // Image example with resizing
    $pdf->Image("../Admin/configuration/uploads/$logo", 15, 12, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->Image("$qrcode", 15, 225, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $content = "<p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            This is to certify that $senderName, $age years old, $nationality Citizen, and belongs to the indigent family of
            Barangay $bgyname, $bgycity. 
            </p>
            <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            This certification is being issued upon the request of the above-named person for whatever legal purpose it may serve him best.
            </p>
            <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ISSUED</b> this $day of $month, $year at the office of the Punong Barangay, Barangay $bgyname, $bgycity City, Philippines.
            </p>
    ";  
    
    $pdf->writeHTML($content, true, false, true, false, '');  
    $pdf->writeHTML('<br><br><br><br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->cell(0, 0, "$chname", 0,1,'R');  
    $pdf->SetFont('times', '', 11);
    $pdf->cell(0, 0, "Barangay Captain    ", 0,1,'R');  

    $pdf->writeHTML('<br><br><br><br><br><br><br><br><br><br>', true, false, true, false, '');  

    $pdf->cell(0, 0, "Request No. $requestID", 0,1,'L');  
    $pdf->cell(0, 0, "Date Issued: $full_date", 0,1,'L');  
    $pdf->cell(0, 0, "Doc. Stamp: paid", 0,1,'L');  
    $pdf->Output("$surname-Certificate-of-Indigency.pdf", 'I');

    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document','Your Certificate of Indigency request is ready.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'completed', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}
if($document_Type == 'Barangay Clearance')
{
    $pdf->SetFont('times', '', 24); 
    $pdf->writeHTML('<br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "BARANGAY CLEARANCE", 0,1,'C');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->writeHTML('<br><br><br><br><br><br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "TO WHOM IT MAY CONCERN:", 0,1,'L');  
    $pdf->writeHTML('<br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', '', 12);
    // Image example with resizing
    $pdf->Image("../Admin/configuration/uploads/$logo", 15, 12, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->Image("$qrcode", 15, 225, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $content = "<p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    This is to certify that $senderName, $age years old, $nationality and a resident of
    Barangay $bgyname, $bgycity is known to be of good moral character and law-abiding citizen in the
    community.
    </p>
    <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    To certify further, that he/she has no derogatory and/or criminal records filed in this barangay.
    </p>
    <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>ISSUED</b> this $day of $month, $year at Barangay $bgyname, $bgycity upon request of the interested party
    for whatever legal purposes it may serve.
    </p>
    ";  
    
    $pdf->writeHTML($content, true, false, true, false, '');  
    $pdf->writeHTML('<br><br><br><br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->cell(0, 0, "$chname", 0,1,'R');  
    $pdf->SetFont('times', '', 11);
    $pdf->cell(0, 0, "Barangay Captain    ", 0,1,'R');  

    $pdf->writeHTML('<br><br><br><br><br><br><br><br><br><br><br>', true, false, true, false, '');  

    $pdf->cell(0, 0, "Request No. $requestID", 0,1,'L');  
    $pdf->cell(0, 0, "Date Issued: $full_date", 0,1,'L');  
    $pdf->cell(0, 0, "Doc. Stamp: paid", 0,1,'L');  
    $pdf->Output("$surname-Barangay-Clearance.pdf", 'I');

    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document','Your Barangay Clearance request is ready.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'completed', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}

if($document_Type == 'Certificate of Residency')
{
    $pdf->SetFont('times', '', 24); 
    $pdf->writeHTML('<br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "CERTIFICATE OF RESIDENCY", 0,1,'C');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->writeHTML('<br><br><br><br><br><br>', true, false, true, false, '');  
    $pdf->cell(0, 0, "TO WHOM IT MAY CONCERN:", 0,1,'L');  
    $pdf->writeHTML('<br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', '', 12);
    // Image example with resizing
    $pdf->Image("../Admin/configuration/uploads/$logo", 15, 12, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->Image("$qrcode", 15, 230, 30, 30, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $content = "<p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    This is to certify that $senderName, $age, $civstatus, $nationality Citizen, whose specimen signature appears below, is a <b>PERMANENT RESIDENT</b> of this Barangay $bgyname, City of $bgyname.
    </p>
    <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Based on records of this office, she has been residing at Barangay $bgyname, City of $bgycity.
    </p>
    <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    This <b>CERTIFICAION</b> is being issued upon the request of the above-named person for whatever legal purpose it may serve.
    </p>
    <p style='text-align:justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>ISSUED</b> this $day of $month, $year at the Barangay $bgyname, $bgycity City, Philippines.
    </p>
    ";  
    
    $pdf->writeHTML($content, true, false, true, false, '');  
    $pdf->writeHTML('<br><br><br><br><br>', true, false, true, false, '');  
    $pdf->SetFont('times', 'B', 11);
    $pdf->cell(0, 0, "$chname", 0,1,'R');  
    $pdf->SetFont('times', '', 11);
    $pdf->cell(0, 0, "Barangay Captain    ", 0,1,'R');  

    $pdf->writeHTML('<br><br><br><br><br><br><br><br><br><br>', true, false, true, false, '');  

    $pdf->cell(0, 0, "Request No. $requestID", 0,1,'L');  
    $pdf->cell(0, 0, "Date Issued: $full_date", 0,1,'L');  
    $pdf->cell(0, 0, "Doc. Stamp: paid", 0,1,'L');  
    $pdf->Output("$surname-Certificate-of-Residency.pdf", 'I');

    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document','Your Certificate of Residency request is ready.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'completed', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}


?>

