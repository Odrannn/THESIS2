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
$date2 = $_POST["date2"];
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

if($document_Type == 'Complaint')
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
    <h1>BARANGAY COMPLAINT</h1>
    </div>
    <br><br>
    
    ";

    

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
    <h1>CERTIFICATE OF SUGGESTION</h1>
    </div>
    <br><br>
    
    ";
    

    
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
    <h1>CERTIFICATE OF BLOTTER</h1>
    </div>
    <br><br>
    ";
    
    
    $options = new Options;
    $options -> setChroot(__DIR__);
    
    $dompdf = new Dompdf($options);
    
    //$dompdf->setPaper("A4", "Landscape");
    
    $dompdf->loadHtml($html);
    
    $dompdf->render();
    
    $dompdf->addInfo("Title", "Barangay Clearance");
    
    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);
}
?>
