<?php
include("../phpfiles/connection.php");
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";
$requestID = $_POST["id"];
$officialID = $_POST["officialid"];
$senderID = $_POST["senderid"];
$documentID = $_POST["documentid"];

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


$day = date("j");
$month = date("F");
$year = date("Y");
$full_date = date("M j, Y");

if($document_Type == 'Barangay Clearance')
{
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

    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document on process','Your Barangay Clearance request is ready.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'ready', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}
if($document_Type == 'Certificate of Indigency')
{
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
    <h1>CERTIFICATE OF INDIGENCY</h1>
    </div>
    <br><br>
    <div style='margin: 0 40px; line-height:200%; text-align: justify;'>
        <b>TO WHOM IT MAY CONCERN:</b>
        <p style='text-indent: 50px;'>
        This is to certify that $senderName, $age years old, $nationality Citizen, and belongs to the indigent family of
        Barangay $bgyname, $bgycity. 
        </p>
        <p style='text-indent: 50px;'>
        This certification is being issued upon the request of the above-named person for whatever legal purpose it may serve him best.
        </p>
        <p style='text-indent: 50px;'>
        <b>ISSUED</b> this $day of $month, $year at the office of the Punong Barangay, Barangay $bgyname, $bgycity City, Philippines.
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


    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document on process','Your Certificate of Indigency request is on process.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'ready', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}

if($document_Type == 'Certificate of Residency')
{
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
    <h1>CERTIFICATE OF RESIDENCY</h1>
    </div>
    <br><br>
    <div style='margin: 0 40px; line-height:200%; text-align: justify;'>
        <b>TO WHOM IT MAY CONCERN:</b>
        <p style='text-indent: 50px;'>
        This is to certify that $senderName, $age, $civstatus, $nationality Citizen, whose specimen signature appears below, is a <b>PERMANENT RESIDENT</b> of this Barangay $bgyname, City of $bgyname.
        </p>
        <p style='text-indent: 50px;'>
        Based on records of this office, she has been residing at Barangay $bgyname, City of $bgycity.
        </p>
        <p style='text-indent: 50px;'>
        This <b>CERTIFICAION</b> is being issued upon the request of the above-named person for whatever legal purpose it may serve.
        </p>
        <p style='text-indent: 50px;'>
        Issued this $day of $month, $year at the Barangay $bgyname, $bgycity City, Philippines.
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

    if(isset($_POST['generate'])){
        //create notif
        $notifdate = date('y-m-d h:i:s');
        $notifquery = "INSERT INTO user_notification(notification_type, message, source_ID, resident_ID, date_time, status)
        VALUES ('Requested Document on process','Your Certificate of Residency request is on process.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.', '$officialID', '$senderID','$notifdate','0');";
        $notifresult = $conn -> query($notifquery);

        //update request status
        $upquery = "UPDATE document_request SET status = 'ready', official_ID = '$officialID' WHERE request_ID = '$requestID';";
        $upresult = $conn -> query($upquery);
    }
}
?>
