<?php
include("../../phpfiles/connection.php");
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";

//get barangay info
include("../../phpfiles/bgy_info.php");
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
//COUNT POPULATION
$comp_query2 = "SELECT COUNT(id) FROM resident_table;";
$comp_result2 = $conn -> query($comp_query2);
$comp_row2 = $comp_result2 -> fetch_array();
$population = $comp_row2[0];
//COUNT DISTINCT HOUSEHOLD
$comp_query3 = "SELECT COUNT(DISTINCT household_ID) FROM resident_table;";
$comp_result3 = $conn -> query($comp_query3);
$comp_row3 = $comp_result3 -> fetch_array();
$household = $comp_row3[0];
//COUNT MALE
$comp_query4 = "SELECT COUNT(id) FROM resident_table WHERE gender='male';";
$comp_result4 = $conn -> query($comp_query4);
$comp_row4 = $comp_result4 -> fetch_array();
$male = $comp_row4[0];
//COUNT FEMALE
$comp_query5 = "SELECT COUNT(id) FROM resident_table WHERE gender='female';";
$comp_result5 = $conn -> query($comp_query5);
$comp_row5 = $comp_result5 -> fetch_array();
$female = $comp_row5[0];

$comp_mnature1 = "SELECT COUNT(id) FROM resident_table WHERE gender='male' AND education='Less Than Highschool';";
$result_mnature1 = $conn -> query($comp_mnature1);
$row_mnature1 = $result_mnature1 -> fetch_array();
$mlesshigh = $row_mnature1[0];

$comp_mnature2 = "SELECT COUNT(id) FROM resident_table WHERE gender='male' AND education='Highschool';";
$result_mnature2 = $conn -> query($comp_mnature2);
$row_mnature2 = $result_mnature2 -> fetch_array();
$mhighschool = $row_mnature2[0];

$comp_mnature3 = "SELECT COUNT(id) FROM resident_table WHERE gender='male' AND education='College';";
$result_mnature3 = $conn -> query($comp_mnature3);
$row_mnature3 = $result_mnature3 -> fetch_array();
$mcollege = $row_mnature3[0];

$comp_mnature4 = "SELECT COUNT(id) FROM resident_table WHERE gender='male' AND education='Bachelor''s Degree';";
$result_mnature4 = $conn -> query($comp_mnature4);
$row_mnature4 = $result_mnature4 -> fetch_array();
$mdegree = $row_mnature4[0];

$comp_fnature1 = "SELECT COUNT(id) FROM resident_table WHERE gender='female' AND education='Less Than Highschool';";
$result_fnature1 = $conn -> query($comp_fnature1);
$row_fnature1 = $result_fnature1 -> fetch_array();
$flesshigh = $row_fnature1[0];

$comp_fnature2 = "SELECT COUNT(id) FROM resident_table WHERE gender='female' AND education='Highschool';";
$result_fnature2 = $conn -> query($comp_fnature2);
$row_fnature2 = $result_fnature2 -> fetch_array();
$fhighschool = $row_fnature2[0];

$comp_fnature3 = "SELECT COUNT(id) FROM resident_table WHERE gender='female' AND education='College';";
$result_fnature3 = $conn -> query($comp_fnature3);
$row_fnature3 = $result_fnature3 -> fetch_array();
$fcollege = $row_fnature3[0];

$comp_fnature4 = "SELECT COUNT(id) FROM resident_table WHERE gender='female' AND education='Bachelor''s Degree';";
$result_fnature4 = $conn -> query($comp_fnature4);
$row_fnature4 = $result_fnature4 -> fetch_array();
$fdegree = $row_fnature4[0];

$tlesshigh = $flesshigh + $mlesshigh;
$thighschool = $fhighschool + $mhighschool;
$tcollege = $fcollege + $mcollege;
$tdegree = $fdegree + $mdegree;





$query3 = "SELECT birthday FROM resident_table WHERE gender='female'";
$result3 = $conn -> query($query3);

$query4 = "SELECT birthday FROM resident_table WHERE gender='male'";
$result4 = $conn -> query($query4);


$query5 = "SELECT birthday FROM resident_table WHERE gender='female' AND civilstatus='Single'";
$result5 = $conn -> query($query5);
$query10 = "SELECT birthday FROM resident_table WHERE gender='female' AND civilstatus='Married'";
$result10 = $conn -> query($query10);
$query11 = "SELECT birthday FROM resident_table WHERE gender='female' AND civilstatus='Widowed'";
$result11 = $conn -> query($query11);
$query12 = "SELECT birthday FROM resident_table WHERE gender='female' AND civilstatus='Divorced'";
$result12 = $conn -> query($query12);


$query6 = "SELECT birthday FROM resident_table WHERE gender='male' AND civilstatus='Single'";
$result6 = $conn -> query($query6);
$query7 = "SELECT birthday FROM resident_table WHERE gender='male' AND civilstatus='Widowed'";
$result7 = $conn -> query($query7);
$query8 = "SELECT birthday FROM resident_table WHERE gender='male' AND civilstatus='Married'";
$result8 = $conn -> query($query8);
$query9 = "SELECT birthday FROM resident_table WHERE gender='male' AND civilstatus='Divorced'";
$result9 = $conn -> query($query9);

$fage4 = 0; 
$fage9 = 0;
$fage14 = 0;
$fage19 = 0;
$fage24 = 0;
$fage29 = 0;
$fage34 = 0;
$fage39 = 0;
$fage44 = 0;
$fage49 = 0;
$fage54 = 0;
$fage59 = 0;
$fage64 = 0;
$fage69 = 0;
$fage74 = 0;
$fage79 = 0;
$fage84 = 0;
$fage85 = 0;

$mage4 = 0;
$mage9 = 0;
$mage14 = 0;
$mage19 = 0;
$mage24 = 0;
$mage29 = 0;
$mage34 = 0;
$mage39 = 0;
$mage44 = 0;
$mage49 = 0;
$mage54 = 0;
$mage59 = 0;
$mage64 = 0;
$mage69 = 0;
$mage74 = 0;
$mage79 = 0;
$mage84 = 0;
$mage85 = 0;


while($row3 = $result3->fetch_assoc()){
	$dateOfBirth = $row3["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	//$age = $row3['birthday'];
	if($age<=4){
		$fage4 = $fage4 + 1;
	} elseif($age<=9){
		$fage9 = $fage9 + 1;
	} elseif($age<=14){
		$fage14 = $fage14 + 1;
	} elseif($age<=19){
		$fage19 = $fage19 + 1; 
	} elseif($age<=24){
		$fage24 = $fage24 + 1; 
	} elseif($age<=29){
		$fage29 = $fage29 + 1;
	} elseif($age<=34){
		$fage34 = $fage34 + 1;
	} elseif($age<=39){
		$fage39 = $fage39 + 1;
	} elseif($age<=44){
		$fage44 = $fage44 + 1;
	} elseif($age<=49){
		$fage49 = $fage49 + 1;
	} elseif($age<=54){
		$fage54 = $fage54 + 1;
	} elseif($age<=59){
		$fage59 = $fage59 + 1;
	} elseif($age<=64){
		$fage64 = $fage64 + 1;
	} elseif($age<=49){
		$fage69 = $fage69 + 1;
	} elseif($age<=74){
		$fage74= $fage74 + 1;
	} elseif($age<=79){
		$fage79 = $fage79 + 1;
	} elseif($age>=80){
		$fage80 = $fage80 + 1;
	} elseif($age>=84){
		$fage84 = $fage84 + 1;
	} else{
		$fage85 = $fage85 + 1;
	} 
}

while($row4 = $result4->fetch_assoc()){
	$dateOfBirth = $row4["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	//$age = $row3['birthday'];
	if($age<=4){
		$mage4 = $mage4 + 1;
	} elseif($age<=9){
		$mage9 = $mage9 + 1;
	} elseif($age<=14){
		$mage14 = $mage14 + 1;
	} elseif($age<=19){
		$mage19 = $mage19 + 1; 
	} elseif($age<=24){
		$mage24 = $mage24 + 1; 
	} elseif($age<=29){
		$mage29 = $mage29 + 1;
	} elseif($age<=34){
		$mage34 = $mage34 + 1;
	} elseif($age<=39){
		$mage39 = $mage39 + 1;
	} elseif($age<=44){
		$mage44 = $mage44 + 1;
	} elseif($age<=49){
		$mage49 = $mage49 + 1;
	} elseif($age<=54){
		$mage54 = $mage54 + 1;
	} elseif($age<=59){
		$mage59 = $mage59 + 1;
	} elseif($age<=64){
		$mage64 = $mage64 + 1;
	} elseif($age<=49){
		$mage69 = $mage69 + 1;
	} elseif($age<=74){
		$mage74= $mage74 + 1;
	} elseif($age<=79){
		$mage79 = $mage79 + 1;
	} elseif($age>=80){
		$mage80 = $mage80 + 1;
	} elseif($age>=84){
		$mage84 = $mage84 + 1;
	} else{
		$mage85 = $mage85 + 1;
	} 
}

$tage4= $mage4+$fage4;
$tage9= $mage9+$fage9;
$tage14= $mage14+$fage14;
$tage19= $mage19+$fage19;
$tage24=$mage24+$fage24;
$tage29=$mage29+$fage29;
$tage34=$mage34+$fage34;
$tage39=$mage39+$fage39;
$tage44=$mage44+$fage44;
$tage49=$mage49+$fage49;
$tage54=$mage54+$fage54;
$tage59=$mage59+$fage59;
$tage64=$mage64+$fage64;
$tage69=$mage69+$fage69;
$tage74=$mage74+$fage74;
$tage79=$mage79+$fage79;
$tage84=$mage84+$fage84;
$tage85=$mage85+$fage85;

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
				<BR>
				<table width='100%'>
				  <thead>
					<tr>
					  <th colspan='4'>BARANGAY RESIDENT REPORT</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td>HOUSEHOLD POPULATION: </td>
						<td colspan='3'>$population</td>
					</tr>
					<tr>
						<td>NUMBER OF HOUSEHOLD: </td>
						<td colspan='3'>$household</td>
				  	</tr>
					<tr>
						<th colspan='4'>SEX</th>
					</tr>
					<tr>
						<td>TOTAL NO. MALE</td>
						<td colspan='3'>$male</td>
				  	</tr>
				  	<tr>
				  		<td>TOTAL NO. FEMALE</td>
				  		<td colspan='3'>$female</td>
					</tr>
				  	<tr>
						<th colspan='4'>AGE DEPENDING ON SEX</th>
					</tr>
					<tr>
						<th>AGE</th>
						<th>TOTAL</th>
						<th>MALE</th>
						<th>FEMALE</th>
					</tr>
					<tr>
						<td>Under 5</td>
						<td>$tage4</td>
						<td>$mage4</td>
						<td>$fage4</td>
				  	</tr>
					<tr>
						<td>5-9</td>
						<td>$tage9</td>
						<td>$mage9</td>
						<td>$fage9</td>
				  	</tr>
					<tr>
						<td>10-14</td>
						<td>$tage14</td>
						<td>$mage14</td>
						<td>$fage14</td>
				  	</tr>
					<tr>
						<td>15-19</td>
						<td>$tage19</td>
						<td>$mage19</td>
						<td>$fage19</td>
				  	</tr>
					<tr>
						<td>20-24</td>
						<td>$tage24</td>
						<td>$mage24</td>
						<td>$fage24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$tage29</td>
						<td>$mage29</td>
						<td>$fage29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$tage34</td>
						<td>$mage34</td>
						<td>$fage34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$tage39</td>
						<td>$mage39</td>
						<td>$fage39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$tage44</td>
						<td>$mage44</td>
						<td>$fage44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$tage49</td>
						<td>$mage49</td>
						<td>$fage49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$tage54</td>
						<td>$mage54</td>
						<td>$fage54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$tage59</td>
						<td>$mage59</td>
						<td>$fage59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$tage64</td>
						<td>$mage64</td>
						<td>$fage64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$tage69</td>
						<td>$mage69</td>
						<td>$fage69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$tage74</td>
						<td>$mage74</td>
						<td>$fage74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$tage79</td>
						<td>$mage79</td>
						<td>$fage79</td>
					</tr>
					<tr>
						<td>80-84</td>
				  		<td>$tage84</td>
						<td>$mage84</td>
						<td>$fage84</td>
					</tr>
					<tr>
						<td>85 and over</td>
				  		<td>$tage85</td>
						<td>$mage85</td>
						<td>$fage85</td>
					</tr>	
					
					<tr>
				  		<th colspan='4'>HIGHEST EDUCATIONAL ATTAINMENT</TH>
					</tr>
					<tr>
						<th>ATTAINMENT</TH>
						<th>TOTAL</TH>
						<th>MALE</TH>
						<th>FEMALE</TH>
			  		</tr>
					<tr>
				  		<td>Less Than Highschool</td>
						<td>$tlesshigh</td>
						<td>$mlesshigh</td>
						<td>$flesshigh</td>
					</tr>
					<tr>
						<td>Highschool</td>
						<td>$thighschool</td>
						<td>$mhighschool</td>
						<td>$fhighschool</td>
					</tr>
					<tr>
						<td>College</td>
						<td>$tcollege</td>
						<td>$mcollege</td>
						<td>$fcollege</td>
					</tr>
					<tr>	
						<td>Degree Holder</td>
						<td>$tdegree</td>
						<td>$mdegree</td>
						<td>$fdegree</td>
				  	</tr>
					  </tbody>
				</table><br><br><br><br><br><br>";

$fsage19 = 0;
$fsage24 = 0;
$fsage29 = 0;
$fsage34 = 0;
$fsage39 = 0;
$fsage44 = 0;
$fsage49 = 0;
$fsage54 = 0;
$fsage59 = 0;
$fsage64 = 0;
$fsage69 = 0;
$fsage74 = 0;
$fsage79 = 0;
$fsage80 = 0;

//Age >= 65 and Age <= 69

while($row5 = $result5->fetch_assoc()){
	$dateOfBirth = $row5["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$fsage24 = $fsage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$fsage29 = $fsage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$fsage34 = $fsage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$fsage39 = $fsage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $fsage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$fsage49 = $fsage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$fsage54 = $fsage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$fsage59 = $fsage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$fsage64 = $fsage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$fsage69 = $fsage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$fsage74= $fsage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$fsage79 = $fsage79 + 1;
	} elseif($age <= 80){
		$fsage80 = $fsage80 + 1;
	}
}


$msage24 = 0;
$msage29 = 0;
$msage34 = 0;
$msage39 = 0;
$msage44 = 0;
$msage49 = 0;
$msage54 = 0;
$msage59 = 0;
$msage64 = 0;
$msage69 = 0;
$msage74 = 0;
$msage79 = 0;
$msage80 = 0;
//SINGLE MALE 
while($row6 = $result6->fetch_assoc()){
	$dateOfBirth = $row6["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$msage24 = $msage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$msage29 = $msage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$msage34 = $msage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$msage39 = $msage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $msage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$msage49 = $msage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$msage54 = $msage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$msage59 = $msage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$msage64 = $msage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$msage69 = $msage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$msage74= $msage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$msage79 = $msage79 + 1;
	} elseif($age <= 80){
		$msage80 = $msage80 + 1;
	}
}

$mmage24 = 0;
$mmage29 = 0;
$mmage34 = 0;
$mmage39 = 0;
$mmage44 = 0;
$mmage49 = 0;
$mmage54 = 0;
$mmage59 = 0;
$mmage64 = 0;
$mmage69 = 0;
$mmage74 = 0;
$mmage79 = 0;
$mmage80 = 0;
//MARRIED MALE 
while($row8 = $result8->fetch_assoc()){
	$dateOfBirth = $row8["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$mmage24 = $mmage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$mmage29 = $mmage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$mmage34 = $mmage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$mmage39 = $mmage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $mmage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$mmage49 = $mmage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$mmage54 = $mmage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$mmage59 = $mmage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$mmage64 = $mmage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$mmage69 = $mmage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$mmage74= $mmage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$mmage79 = $mmage79 + 1;
	} elseif($age <= 80){
		$mmage80 = $mmage80 + 1;
	}
}
$mwage19 = 0;
$mwage24 = 0;
$mwage29 = 0;
$mwage34 = 0;
$mwage39 = 0;
$mwage44 = 0;
$mwage49 = 0;
$mwage54 = 0;
$mwage59 = 0;
$mwage64 = 0;
$mwage69 = 0;
$mwage74 = 0;
$mwage79 = 0;
$mwage80 = 0;
//WIDOWED MALE 
while($row7 = $result7->fetch_assoc()){
	$dateOfBirth = $row7["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$mwage24 = $mwage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$mwage29 = $mwage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$mwage34 = $mwage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$mwage39 = $mwage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $mwage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$mwage49 = $mwage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$mwage54 = $mwage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$mwage59 = $mwage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$mwage64 = $mwage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$mwage69 = $mwage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$mwage74= $mwage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$mwage79 = $mwage79 + 1;
	} elseif($age >= 80){
		$mwage80 = $mwage80 + 1;
	}
}
$mdage24 = 0;
$mdage29 = 0;
$mdage34 = 0;
$mdage39 = 0;
$mdage44 = 0;
$mdage49 = 0;
$mdage54 = 0;
$mdage59 = 0;
$mdage64 = 0;
$mdage69 = 0;
$mdage74 = 0;
$mdage79 = 0;
$mdage80 = 0;
//DIVORCED MALE 
while($row9 = $result9->fetch_assoc()){
	$dateOfBirth = $row9["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$mdage24 = $mdage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$mdage29 = $mdage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$mdage34 = $mdage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$mdage39 = $mdage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $mdage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$mdage49 = $mdage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$mdage54 = $mdage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$mdage59 = $mdage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$mdage64 = $mdage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$mdage69 = $mdage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$mdage74= $mdage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$mdage79 = $mdage79 + 1;
	} elseif($age >= 80){
		$mdage80 = $mdage80 + 1;
	}
}


$fmage19 = 0;
$fmage24 = 0;
$fmage29 = 0;
$fmage34 = 0;
$fmage39 = 0;
$fmage44 = 0;
$fmage49 = 0;
$fmage54 = 0;
$fmage59 = 0;
$fmage64 = 0;
$fmage69 = 0;
$fmage74 = 0;
$fmage79 = 0;
$fmage80 = 0;
//FEMALE MARRIED
while($row10 = $result10->fetch_assoc()){
	$dateOfBirth = $row10["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$fmage24 = $fmage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$fmage29 = $fmage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$fmage34 = $fmage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$fmage39 = $fmage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $fmage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$fmage49 = $fmage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$fmage54 = $fmage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$fmage59 = $fmage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$fmage64 = $fmage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$fmage69 = $fmage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$fmage74= $fmage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$fmage79 = $fmage79 + 1;
	} elseif($age <= 80){
		$fmage80 = $fmage80 + 1;
	}
}

$fdage19 = 0;
$fdage24 = 0;
$fdage29 = 0;
$fdage34 = 0;
$fdage39 = 0;
$fdage44 = 0;
$fdage49 = 0;
$fdage54 = 0;
$fdage59 = 0;
$fdage64 = 0;
$fdage69 = 0;
$fdage74 = 0;
$fdage79 = 0;
$fdage80 = 0;
//DIVORCED FEMALE
while($row12 = $result12->fetch_assoc()){
	$dateOfBirth = $row12["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$fdage24 = $fdage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$fdage29 = $fdage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$fdage34 = $fdage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$fdage39 = $fdage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $fdage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$fdage49 = $fdage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$fdage54 = $fdage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$fdage59 = $fdage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$fdage64 = $fdage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$fdage69 = $fdage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$fdage74= $fdage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$fdage79 = $fdage79 + 1;
	} elseif($age <= 80){
		$fdage80 = $fdage80 + 1;
	}
}

$fwage19 = 0;
$fwage24 = 0;
$fwage29 = 0;
$fwage34 = 0;
$fwage39 = 0;
$fwage44 = 0;
$fwage49 = 0;
$fwage54 = 0;
$fwage59 = 0;
$fwage64 = 0;
$fwage69 = 0;
$fwage74 = 0;
$fwage79 = 0;
$fwage80 = 0;
//WIDOWED FEMALE 
while($row11 = $result11->fetch_assoc()){
	$dateOfBirth = $row11["birthday"];
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');
	if($age >=20 and $age <= 24){
		$fwage24 = $fwage24 + 1; 
	} elseif($age >=25 and $age <= 29){
		$fwage29 = $fwage29 + 1;
	} elseif($age >=30 and $age <= 34){
		$fwage34 = $fwage34 + 1;
	} elseif($age >=35 and $age <= 39){
		$fwage39 = $fwage39 + 1;
	} elseif($age >=40 and $age <= 44){
		$sfage44 = $fwage44 + 1;
	} elseif($age >=45 and $age <= 49){
		$fwage49 = $fwage49 + 1;
	} elseif($age >=50 and $age <= 54){
		$fwage54 = $fwage54 + 1;
	} elseif($age >=55 and $age <= 59){
		$fwage59 = $fwage59 + 1;
	} elseif($age >=60 and $age <= 64){
		$fwage64 = $fwage64 + 1;
	} elseif($age >=65 and $age <= 69){
		$fwage69 = $fwage69 + 1;
	} elseif($age >=70 and $age <= 74){
		$fwage74= $fwage74 + 1;
	} elseif($age >=75 and $age <= 79){
		$fwage79 = $fwage79 + 1;
	} elseif($age <= 80){
		$fwage80 = $fwage80 + 1;
	}
}


$ts24 = $fsage24 +$msage24;
$tm24 = $fmage24 +$mmage24;
$tw24 = $fwage24 +$mwage24;
$td24 = $fdage24 +$mdage24;

$ts29 = $fsage29 +$msage29;
$tm29 = $fmage29 +$mmage29;
$tw29 = $fwage29 +$mwage29;
$td29 = $fdage29 +$mdage29;

$ts34 = $fsage34 +$msage34;
$tm34 = $fmage34 +$mmage34;
$tw34 = $fwage34 +$mwage34;
$td34 = $fdage34 +$mdage34;

$ts39 = $fsage39 +$msage39;
$tm39 = $fmage39 +$mmage39;
$tw39 = $fwage39 +$mwage39;
$td39 = $fdage39 +$mdage39;

$ts44 = $fsage44 +$msage44;
$tm44 = $fmage44 +$mmage44;
$tw44 = $fwage44 +$mwage44;
$td44 = $fdage44 +$mdage44;

$ts49 = $fsage49+ $msage49;
$tm49 = $fmage49+$mmage49;
$tw49 = $fwage49+ $mwage49;
$td49 = $fdage49 +$mdage49;

$ts54 = $fsage54+ $msage54;
$tm54 = $fmage54+ $mmage54;
$tw54 = $fwage54+ $mwage54;
$td54 = $fdage54+ $mdage54;

$ts59 = $fsage59+ $msage59;
$tm59 = $fmage59+ $mmage59;
$tw59 = $fwage59+ $mwage59;
$td59 = $fdage59 +$mdage59;

$ts64 = $fsage64+ $msage64;
$tm64 = $fmage64+ $mmage64;
$tw64 = $fwage64+ $mwage64;
$td64 = $fdage64+ $mdage64;

$ts69 = $fsage69+ $msage69;
$tm69 = $fmage69+ $mmage69;
$tw69 = $fwage69+ $mwage69;
$td69 = $fdage69+ $mdage69;

$ts74 = $fsage74+ $msage74;
$tm74 = $fmage74+ $mmage74;
$tw74 = $fwage74+ $mwage74;
$td74 = $fdage74+ $mdage74;

$ts79 = $fsage79+ $msage79;
$tm79 = $fmage79+ $mmage79;
$tw79 = $fwage79+ $mwage79;
$td79 = $fdage79 +$mdage79;

$ts80 = $fsage80+ $msage80;
$tm80 = $fmage80+ $mmage80;
$tw80 = $fwage80+ $mwage80;
$td80 = $fdage80+ $mdage80;



			$html .="<table width='100%'>
				  	<thead>
				  		<th colspan='5'>MARITAL STATUS</th>
					</thead>
					<tbody>
				  		<th>FEMALE</th>
						<th>Single</th>
						<th>Married</th>
						<th>Widowed</th>
						<th>Divorced</th>
					</tbody>

					<tr>
						<td>20-24</td>
						<td>$fsage24</td>
						<td>$fmage24</td>
						<td>$fwage24</td>
						<td>$fdage24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$fsage29</td>
						<td>$fmage29</td>
						<td>$fwage29</td>
						<td>$fdage29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$fsage34</td>
						<td>$fmage34</td>
						<td>$fwage34</td>
						<td>$fdage34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$fsage39</td>
						<td>$fmage39</td>
						<td>$fwage39</td>
						<td>$fdage39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$fsage44</td>
						<td>$fmage44</td>
						<td>$fwage44</td>
						<td>$fdage44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$fsage49</td>
						<td>$fmage49</td>
						<td>$fwage49</td>
						<td>$fdage49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$fsage54</td>
						<td>$fmage54</td>
						<td>$fwage54</td>
						<td>$fdage54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$fsage59</td>
						<td>$fmage59</td>
						<td>$fwage59</td>
						<td>$fdage59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$fsage64</td>
						<td>$fmage64</td>
						<td>$fwage64</td>
						<td>$fdage64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$fsage69</td>
						<td>$fmage69</td>
						<td>$fwage69</td>
						<td>$fdage69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$fsage74</td>
						<td>$fmage74</td>
						<td>$fwage74</td>
						<td>$fdage74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$fsage79</td>
						<td>$fmage79</td>
						<td>$fwage79</td>
						<td>$fdage79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$fsage80</td>
						<td>$fmage80</td>
						<td>$fwage80</td>
						<td>$fdage80</td>

					<tbody>
				  		<th>MALE</th>
						<th>Single</th>
						<th>Married</th>
						<th>Widowed</th>
						<th>Divorced</th>
					</tbody>
					<tr>
						<td>20-24</td>
						<td>$msage24</td>
						<td>$mmage24</td>
						<td>$mwage24</td>
						<td>$mdage24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$msage29</td>
						<td>$mmage29</td>
						<td>$mwage29</td>
						<td>$mdage29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$msage34</td>
						<td>$mmage34</td>
						<td>$mwage34</td>
						<td>$mdage34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$msage39</td>
						<td>$mmage39</td>
						<td>$mwage39</td>
						<td>$mdage39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$msage44</td>
						<td>$mmage44</td>
						<td>$mwage44</td>
						<td>$mdage44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$msage49</td>
						<td>$mmage49</td>
						<td>$mwage49</td>
						<td>$mdage49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$msage54</td>
						<td>$mmage54</td>
						<td>$mwage54</td>
						<td>$mdage54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$msage59</td>
						<td>$mmage59</td>
						<td>$mwage59</td>
						<td>$mdage59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$msage64</td>
						<td>$mmage64</td>
						<td>$mwage64</td>
						<td>$mdage64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$msage69</td>
						<td>$mmage69</td>
						<td>$mwage69</td>
						<td>$mdage69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$msage74</td>
						<td>$mmage74</td>
						<td>$mwage74</td>
						<td>$mdage74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$msage79</td>
						<td>$mmage79</td>
						<td>$mwage79</td>
						<td>$mdage79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$msage80</td>
						<td>$mmage80</td>
						<td>$mwage80</td>
						<td>$mdage80</td>
					</tr>

				  	<tbody>
				  		<th>TOTAL</th>
						<th>Single</th>
						<th>Married</th>
						<th>Widowed</th>
						<th>Divorced</th>
					</tbody>
					<tr>
						<td>20-24</td>
						<td>$ts24</td>
						<td>$tm24</td>
						<td>$tw24</td>
						<td>$td24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$ts29</td>
						<td>$tm29</td>
						<td>$tw29</td>
						<td>$td29</td>
					</tr>

					<tr>
						<td>30-34</td>
						<td>$ts34</td>
						<td>$tm34</td>
						<td>$tw34</td>
						<td>$td34</td>
					</tr>
					<tr>
						<td>35-39</td>
						<td>$ts39</td>
						<td>$tm39</td>
						<td>$tw39</td>
						<td>$td39</td>
					</tr>					
					<tr>
						<td>40-44</td>
						<td>$ts44</td>
						<td>$tm44</td>
						<td>$tw44</td>
						<td>$td44</td>
					</tr>
					<tr>
						<td>45-49</td>
						<td>$ts49</td>
						<td>$tm49</td>
						<td>$tw49</td>
						<td>$td49</td>
					</tr>
					<tr>
						<td>50-54</td>
						<td>$ts54</td>
						<td>$tm54</td>
						<td>$tw54</td>
						<td>$td54</td>
					</tr>
					<tr>
						<td>55-59</td>
						<td>$ts59</td>
						<td>$tm59</td>
						<td>$tw59</td>
						<td>$td59</td>
					</tr>
					<tr>
						<td>60-64</td>
						<td>$ts64</td>
						<td>$tm64</td>
						<td>$tw64</td>
						<td>$td64</td>
					</tr>
					<tr>
						<td>65-69</td>
						<td>$ts69</td>
						<td>$tm69</td>
						<td>$tw69</td>
						<td>$td69</td>
					</tr>					
					<tr>
						<td>70-74</td>
						<td>$ts74</td>
						<td>$tm74</td>
						<td>$tw74</td>
						<td>$td74</td>
					</tr>
					<tr>
						<td>75-79</td>
						<td>$ts79</td>
						<td>$tm79</td>
						<td>$tw79</td>
						<td>$td79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$ts80</td>
						<td>$tm80</td>
						<td>$tw80</td>
						<td>$td80</td>
					</tr>	

					</table>
						
			";


			$html .="
				</body>
			</html>";
			
    $dompdf = new Dompdf();

    //$dompdf->setPaper("A4", "Landscape");

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->addInfo("Title", "POPULATION REPORT");

    $dompdf->stream("populationreport.pdf", ["Attachment" => 0]);
?>