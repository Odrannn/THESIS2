<?php
include('../../phpfiles/connection.php');

if (isset($_POST['start'])){
    $start = $conn -> real_escape_string($_POST['start']);

    $allData = '';
    $resultm = $conn -> query("SELECT * FROM resident_table LIMIT $start, 50;");
    while($row = $resultm->fetch_assoc()){ 
        $allData .= $row["id"] . ',' . $row["user_id"] . ',' . $row["fname"] . "\n";
    }
    exit(json_encode(array("data" => $allData)));
}
$sql = $conn -> query("SELECT id FROM resident_table;");
$numRows = mysqli_num_rows($sql);
?>
