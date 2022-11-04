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
//COUNT POPULATION
$comp_query2 = "SELECT COUNT(user_id) FROM resident_table;";
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





//count 5-below female status agef
$comp_agef5 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and ( Age <= 4);";
$result_agef5 = $conn -> query($comp_agef5);
$row_agef5 = $result_agef5 -> fetch_array();
$agef5 = $row_agef5[0];
//count 5-9 female status agef
$comp_agef9 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 5 and Age <= 9);";
$result_agef9 = $conn -> query($comp_agef9);
$row_agef9 = $result_agef9 -> fetch_array();
$agef9 = $row_agef9[0];
//count 10-14 female status agef
$comp_agef14 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 10 and Age <= 14);";
$result_agef14 = $conn -> query($comp_agef14);
$row_agef14 = $result_agef14 -> fetch_array();
$agef14 = $row_agef14[0];
//count 15-19 female status agef
$comp_agef19 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 15 and Age <= 19);";
$result_agef19 = $conn -> query($comp_agef19);
$row_agef19 = $result_agef19 -> fetch_array();
$agef19 = $row_agef19[0];
//count 20-24 female status agef
$comp_agef24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 20 and Age <= 24);";
$result_agef24 = $conn -> query($comp_agef24);
$row_agef24 = $result_agef24 -> fetch_array();
$agef24 = $row_agef24[0];
//count 25-29 female status agef
$comp_agef29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 25 and Age <= 29);";
$result_agef29 = $conn -> query($comp_agef29);
$row_agef29 = $result_agef29 -> fetch_array();
$agef29 = $row_agef29[0];
//count 30-34 female status agef
$comp_agef34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 30 and Age <= 34);";
$result_agef34 = $conn -> query($comp_agef34);
$row_agef34 = $result_agef34 -> fetch_array();
$agef34 = $row_agef34[0];
//count 35-39 female status agef
$comp_agef39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 35 and Age <= 39);";
$result_agef39 = $conn -> query($comp_agef39);
$row_agef39 = $result_agef39 -> fetch_array();
$agef39 = $row_agef39[0];
//count 40-44 female status agef
$comp_agef44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 40 and Age <= 44);";
$result_agef44 = $conn -> query($comp_agef44);
$row_agef44 = $result_agef44 -> fetch_array();
$agef44 = $row_agef44[0];
//count 45-49 female status agef
$comp_agef49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 45 and Age <= 49);";
$result_agef49 = $conn -> query($comp_agef49);
$row_agef49 = $result_agef49 -> fetch_array();
$agef49 = $row_agef49[0];
//count 50-54 female status agef
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$agef54 = $row54[0];
//count 55-59 female status agef
$comp_agef59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 55 and Age <= 59);";
$result_agef59 = $conn -> query($comp_agef59);
$row_agef59 = $result_agef59 -> fetch_array();
$agef59 = $row_agef59[0];
//count 60-64 female status agef
$comp_agef64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 60 and Age <= 64);";
$result_agef64 = $conn -> query($comp_agef64);
$row_agef64 = $result_agef64 -> fetch_array();
$agef64 = $row_agef64[0];
//count 65-69 female status agef
$comp_agef69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 65 and Age <= 69);";
$result_agef69 = $conn -> query($comp_agef69);
$row_agef69 = $result_agef69 -> fetch_array();
$agef69 = $row_agef69[0];
//count 70-74 female status agef
$comp_agef74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 70 and Age <= 74);";
$result_agef74 = $conn -> query($comp_agef74);
$row_agef74 = $result_agef74 -> fetch_array();
$agef74 = $row_agef74[0];
//count 75-79 female status agef
$comp_agef79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 75 and Age <= 79);";
$result_agef79 = $conn -> query($comp_agef79);
$row_agef79 = $result_agef79 -> fetch_array();
$agef79 = $row_agef79[0];
//count 80-84 female status agef
$comp_agef84 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 80 and Age <= 84);";
$result_agef84 = $conn -> query($comp_agef84);
$row_agef84 = $result_agef84 -> fetch_array();
$agef84 = $row_agef84[0];

//count 85-OVER female status agef
$comp_agef85 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and (Age >= 85);";
$result_agef85 = $conn -> query($comp_agef85);
$row_agef85 = $result_agef85 -> fetch_array();
$agef85 = $row_agef85[0];
//count 5-below male status agem
$comp_agem5 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and ( Age <= 4);";
$result_agem5 = $conn -> query($comp_agem5);
$row_agem5 = $result_agem5 -> fetch_array();
$agem5 = $row_agem5[0];
//count 5-9 male status agem
$comp_agem9 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 5 and Age <= 9);";
$result_agem9 = $conn -> query($comp_agem9);
$row_agem9 = $result_agem9 -> fetch_array();
$agem9 = $row_agem9[0];
//count 10-14 male status agem
$comp_agem14 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 10 and Age <= 14);";
$result_agem14 = $conn -> query($comp_agem14);
$row_agem14 = $result_agem14 -> fetch_array();
$agem14 = $row_agem14[0];
//count 15-19 male status agem
$comp_agem19 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 15 and Age <= 19);";
$result_agem19 = $conn -> query($comp_agem19);
$row_agem19 = $result_agem19 -> fetch_array();
$agem19 = $row_agem19[0];
//count 20-24 male status agem
$comp_agem24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 20 and Age <= 24);";
$result_agem24 = $conn -> query($comp_agem24);
$row_agem24 = $result_agem24 -> fetch_array();
$agem24 = $row_agem24[0];
//count 25-29 male status agem
$comp_agem29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 25 and Age <= 29);";
$result_agem29 = $conn -> query($comp_agem29);
$row_agem29 = $result_agem29 -> fetch_array();
$agem29 = $row_agem29[0];
//count 30-34 male status agem
$comp_agem34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 30 and Age <= 34);";
$result_agem34 = $conn -> query($comp_agem34);
$row_agem34 = $result_agem34 -> fetch_array();
$agem34 = $row_agem34[0];
//count 35-39 male status agem
$comp_agem39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 35 and Age <= 39);";
$result_agem39 = $conn -> query($comp_agem39);
$row_agem39 = $result_agem39 -> fetch_array();
$agem39 = $row_agem39[0];
//count 40-44 male status agem
$comp_agem44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 40 and Age <= 44);";
$result_agem44 = $conn -> query($comp_agem44);
$row_agem44 = $result_agem44 -> fetch_array();
$agem44 = $row_agem44[0];
//count 45-49 male status agem
$comp_agem49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 45 and Age <= 49);";
$result_agem49 = $conn -> query($comp_agem49);
$row_agem49 = $result_agem49 -> fetch_array();
$agem49 = $row_agem49[0];
//count 50-54 male status agem
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$agem54 = $row54[0];
//count 55-59 male status agem
$comp_agem59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 55 and Age <= 59);";
$result_agem59 = $conn -> query($comp_agem59);
$row_agem59 = $result_agem59 -> fetch_array();
$agem59 = $row_agem59[0];
//count 60-64 male status agem
$comp_agem64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 60 and Age <= 64);";
$result_agem64 = $conn -> query($comp_agem64);
$row_agem64 = $result_agem64 -> fetch_array();
$agem64 = $row_agem64[0];
//count 65-69 male status agem
$comp_agem69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 65 and Age <= 69);";
$result_agem69 = $conn -> query($comp_agem69);
$row_agem69 = $result_agem69 -> fetch_array();
$agem69 = $row_agem69[0];
//count 70-74 male status agem
$comp_agem74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 70 and Age <= 74);";
$result_agem74 = $conn -> query($comp_agem74);
$row_agem74 = $result_agem74 -> fetch_array();
$agem74 = $row_agem74[0];
//count 75-79 male status agem
$comp_agem79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 75 and Age <= 79);";
$result_agem79 = $conn -> query($comp_agem79);
$row_agem79 = $result_agem79 -> fetch_array();
$agem79 = $row_agem79[0];
//count 80-84 male status agem
$comp_agem84 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 80 and Age <= 84);";
$result_agem84 = $conn -> query($comp_agem84);
$row_agem84 = $result_agem84 -> fetch_array();
$agem84 = $row_agem84[0];

//count 85-OVER male status agem
$comp_agem85 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and (Age >= 85);";
$result_agem85 = $conn -> query($comp_agem85);
$row_agem85 = $result_agem85 -> fetch_array();
$agem85 = $row_agem85[0];

$tsex5 = $agem5 + $agef5;
$tsex9 = $agem9 + $agef9;
$tsex14 = $agem14 + $agef14;
$tsex19 = $agem19 + $agef19;
$tsex24 = $agem24 + $agef24;
$tsex29 = $agem29 + $agef29;
$tsex34 = $agem34 + $agef34;
$tsex39 = $agem39 + $agef39;
$tsex44 = $agem44 + $agef44;
$tsex49 = $agem49 + $agef49;
$tsex54 = $agem54 + $agef54;
$tsex59 = $agem59 + $agef59;
$tsex64 = $agem64 + $agef64;
$tsex69 = $agem69 + $agef69;
$tsex74 = $agem74 + $agef74;
$tsex79 = $agem79 + $agef79;
$tsex84 = $agem84 + $agef84;
$tsex85 = $agem85 + $agef85;



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
						<td>$tsex5</td>
						<td>$agem5</td>
						<td>$agef5</td>
				  	</tr>
					<tr>
						<td>5-9</td>
						<td>$tsex9</td>
						<td>$agem9</td>
						<td>$agef9</td>
				  	</tr>
					<tr>
						<td>10-14</td>
						<td>$tsex14</td>
						<td>$agem14</td>
						<td>$agef14</td>
				  	</tr>
					<tr>
						<td>15-19</td>
						<td>$tsex19</td>
						<td>$agem19</td>
						<td>$agef19</td>
				  	</tr>
					<tr>
						<td>20-24</td>
						<td>$tsex24</td>
						<td>$agem24</td>
						<td>$agef24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$tsex29</td>
						<td>$agem29</td>
						<td>$agef29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$tsex34</td>
						<td>$agem34</td>
						<td>$agef34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$tsex39</td>
						<td>$agem39</td>
						<td>$agef39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$tsex44</td>
						<td>$agem44</td>
						<td>$agef44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$tsex49</td>
						<td>$agem49</td>
						<td>$agef49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$tsex54</td>
						<td>$agem54</td>
						<td>$agef54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$tsex59</td>
						<td>$agem59</td>
						<td>$agef59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$tsex64</td>
						<td>$agem64</td>
						<td>$agef64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$tsex69</td>
						<td>$agem69</td>
						<td>$agef69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$tsex74</td>
						<td>$agem74</td>
						<td>$agef74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$tsex79</td>
						<td>$agem79</td>
						<td>$agef79</td>
					</tr>
					<tr>
						<td>80-84</td>
				  		<td>$tsex84</td>
						<td>$agem84</td>
						<td>$agef84</td>
					</tr>
					<tr>
						<td>85 and over</td>
				  		<td>$tsex85</td>
						<td>$agem85</td>
						<td>$agef85</td>
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

//count 20-24 female status fSingle
$comp_fSingle24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 20 and Age <= 24);";
$result_fSingle24 = $conn -> query($comp_fSingle24);
$row2_fSingle24 = $result_fSingle24 -> fetch_array();
$fSingle24 = $row2_fSingle24[0];
//count 25-29 female status fSingle
$comp_fSingle29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 25 and Age <= 29);";
$result_fSingle29 = $conn -> query($comp_fSingle29);
$row_fSingle29 = $result_fSingle29 -> fetch_array();
$fSingle29 = $row_fSingle29[0];
//count 30-34 female status fSingle
$comp_fSingle34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 30 and Age <= 34);";
$result_fSingle34 = $conn -> query($comp_fSingle34);
$row_fSingle34 = $result_fSingle34 -> fetch_array();
$fSingle34 = $row_fSingle34[0];
//count 35-39 female status fSingle
$comp_fSingle39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 35 and Age <= 39);";
$result_fSingle39 = $conn -> query($comp_fSingle39);
$row_fSingle39 = $result_fSingle39 -> fetch_array();
$fSingle39 = $row_fSingle39[0];
//count 40-44 female status fSingle
$comp_fSingle44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 40 and Age <= 44);";
$result_fSingle44 = $conn -> query($comp_fSingle44);
$row_fSingle44 = $result_fSingle44 -> fetch_array();
$fSingle44 = $row_fSingle44[0];
//count 45-49 female status fSingle
$comp_fSingle49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 45 and Age <= 49);";
$result_fSingle49 = $conn -> query($comp_fSingle49);
$row_fSingle49 = $result_fSingle49 -> fetch_array();
$fSingle49 = $row_fSingle49[0];
//count 50-54 female status fSingle
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$fSingle54 = $row54[0];
//count 55-59 female status fSingle
$comp_fSingle59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 55 and Age <= 59);";
$result_fSingle59 = $conn -> query($comp_fSingle59);
$row_fSingle59 = $result_fSingle59 -> fetch_array();
$fSingle59 = $row_fSingle59[0];
//count 60-64 female status fSingle
$comp_fSingle64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 60 and Age <= 64);";
$result_fSingle64 = $conn -> query($comp_fSingle64);
$row_fSingle64 = $result_fSingle64 -> fetch_array();
$fSingle64 = $row_fSingle64[0];
//count 65-69 female status fSingle
$comp_fSingle69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 65 and Age <= 69);";
$result_fSingle69 = $conn -> query($comp_fSingle69);
$row_fSingle69 = $result_fSingle69 -> fetch_array();
$fSingle69 = $row_fSingle69[0];
//count 70-74 female status fSingle
$comp_fSingle74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 70 and Age <= 74);";
$result_fSingle74 = $conn -> query($comp_fSingle74);
$row_fSingle74 = $result_fSingle74 -> fetch_array();
$fSingle74 = $row_fSingle74[0];
//count 75-79 female status fSingle
$comp_fSingle79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 75 and Age <= 79);";
$result_fSingle79 = $conn -> query($comp_fSingle79);
$row_fSingle79 = $result_fSingle79 -> fetch_array();
$fSingle79 = $row_fSingle79[0];
//count 80-OVER female status fSingle
$comp_fSingle80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Single' and (Age >= 80);";
$result_fSingle80 = $conn -> query($comp_fSingle80);
$row_fSingle80 = $result_fSingle80 -> fetch_array();
$fSingle80 = $row_fSingle80[0];

//count 20-24 female status fMarried
$comp_fMarried24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 20 and Age <= 24);";
$result_fMarried24 = $conn -> query($comp_fMarried24);
$row2_fMarried24 = $result_fMarried24 -> fetch_array();
$fMarried24 = $row2_fMarried24[0];
//count 25-29 female status fMarried
$comp_fMarried29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 25 and Age <= 29);";
$result_fMarried29 = $conn -> query($comp_fMarried29);
$row_fMarried29 = $result_fMarried29 -> fetch_array();
$fMarried29 = $row_fMarried29[0];
//count 30-34 female status fMarried
$comp_fMarried34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 30 and Age <= 34);";
$result_fMarried34 = $conn -> query($comp_fMarried34);
$row_fMarried34 = $result_fMarried34 -> fetch_array();
$fMarried34 = $row_fMarried34[0];
//count 35-39 female status fMarried
$comp_fMarried39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 35 and Age <= 39);";
$result_fMarried39 = $conn -> query($comp_fMarried39);
$row_fMarried39 = $result_fMarried39 -> fetch_array();
$fMarried39 = $row_fMarried39[0];
//count 40-44 female status fMarried
$comp_fMarried44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 40 and Age <= 44);";
$result_fMarried44 = $conn -> query($comp_fMarried44);
$row_fMarried44 = $result_fMarried44 -> fetch_array();
$fMarried44 = $row_fMarried44[0];
//count 45-49 female status fMarried
$comp_fMarried49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 45 and Age <= 49);";
$result_fMarried49 = $conn -> query($comp_fMarried49);
$row_fMarried49 = $result_fMarried49 -> fetch_array();
$fMarried49 = $row_fMarried49[0];
//count 50-54 female status fMarried
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$fMarried54 = $row54[0];
//count 55-59 female status fMarried
$comp_fMarried59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 55 and Age <= 59);";
$result_fMarried59 = $conn -> query($comp_fMarried59);
$row_fMarried59 = $result_fMarried59 -> fetch_array();
$fMarried59 = $row_fMarried59[0];
//count 60-64 female status fMarried
$comp_fMarried64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 60 and Age <= 64);";
$result_fMarried64 = $conn -> query($comp_fMarried64);
$row_fMarried64 = $result_fMarried64 -> fetch_array();
$fMarried64 = $row_fMarried64[0];
//count 65-69 female status fMarried
$comp_fMarried69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 65 and Age <= 69);";
$result_fMarried69 = $conn -> query($comp_fMarried69);
$row_fMarried69 = $result_fMarried69 -> fetch_array();
$fMarried69 = $row_fMarried69[0];
//count 70-74 female status fMarried
$comp_fMarried74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 70 and Age <= 74);";
$result_fMarried74 = $conn -> query($comp_fMarried74);
$row_fMarried74 = $result_fMarried74 -> fetch_array();
$fMarried74 = $row_fMarried74[0];
//count 75-79 female status fMarried
$comp_fMarried79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 75 and Age <= 79);";
$result_fMarried79 = $conn -> query($comp_fMarried79);
$row_fMarried79 = $result_fMarried79 -> fetch_array();
$fMarried79 = $row_fMarried79[0];
//count 80-OVER female status fMarried
$comp_fMarried80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Married' and (Age >= 80);";
$result_fMarried80 = $conn -> query($comp_fMarried80);
$row_fMarried80 = $result_fMarried80 -> fetch_array();
$fMarried80 = $row_fMarried80[0];

//count 20-24 female status fWidowed
$comp_fWidowed24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 20 and Age <= 24);";
$result_fWidowed24 = $conn -> query($comp_fWidowed24);
$row2_fWidowed24 = $result_fWidowed24 -> fetch_array();
$fWidowed24 = $row2_fWidowed24[0];
//count 25-29 female status fWidowed
$comp_fWidowed29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 25 and Age <= 29);";
$result_fWidowed29 = $conn -> query($comp_fWidowed29);
$row_fWidowed29 = $result_fWidowed29 -> fetch_array();
$fWidowed29 = $row_fWidowed29[0];
//count 30-34 female status fWidowed
$comp_fWidowed34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 30 and Age <= 34);";
$result_fWidowed34 = $conn -> query($comp_fWidowed34);
$row_fWidowed34 = $result_fWidowed34 -> fetch_array();
$fWidowed34 = $row_fWidowed34[0];
//count 35-39 female status fWidowed
$comp_fWidowed39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 35 and Age <= 39);";
$result_fWidowed39 = $conn -> query($comp_fWidowed39);
$row_fWidowed39 = $result_fWidowed39 -> fetch_array();
$fWidowed39 = $row_fWidowed39[0];
//count 40-44 female status fWidowed
$comp_fWidowed44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 40 and Age <= 44);";
$result_fWidowed44 = $conn -> query($comp_fWidowed44);
$row_fWidowed44 = $result_fWidowed44 -> fetch_array();
$fWidowed44 = $row_fWidowed44[0];
//count 45-49 female status fWidowed
$comp_fWidowed49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 45 and Age <= 49);";
$result_fWidowed49 = $conn -> query($comp_fWidowed49);
$row_fWidowed49 = $result_fWidowed49 -> fetch_array();
$fWidowed49 = $row_fWidowed49[0];
//count 50-54 female status fWidowed
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$fWidowed54 = $row54[0];
//count 55-59 female status fWidowed
$comp_fWidowed59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 55 and Age <= 59);";
$result_fWidowed59 = $conn -> query($comp_fWidowed59);
$row_fWidowed59 = $result_fWidowed59 -> fetch_array();
$fWidowed59 = $row_fWidowed59[0];
//count 60-64 female status fWidowed
$comp_fWidowed64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 60 and Age <= 64);";
$result_fWidowed64 = $conn -> query($comp_fWidowed64);
$row_fWidowed64 = $result_fWidowed64 -> fetch_array();
$fWidowed64 = $row_fWidowed64[0];
//count 65-69 female status fWidowed
$comp_fWidowed69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 65 and Age <= 69);";
$result_fWidowed69 = $conn -> query($comp_fWidowed69);
$row_fWidowed69 = $result_fWidowed69 -> fetch_array();
$fWidowed69 = $row_fWidowed69[0];
//count 70-74 female status fWidowed
$comp_fWidowed74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 70 and Age <= 74);";
$result_fWidowed74 = $conn -> query($comp_fWidowed74);
$row_fWidowed74 = $result_fWidowed74 -> fetch_array();
$fWidowed74 = $row_fWidowed74[0];
//count 75-79 female status fWidowed
$comp_fWidowed79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 75 and Age <= 79);";
$result_fWidowed79 = $conn -> query($comp_fWidowed79);
$row_fWidowed79 = $result_fWidowed79 -> fetch_array();
$fWidowed79 = $row_fWidowed79[0];
//count 80-OVER female status fWidowed
$comp_fWidowed80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Widowed' and (Age >= 80);";
$result_fWidowed80 = $conn -> query($comp_fWidowed80);
$row_fWidowed80 = $result_fWidowed80 -> fetch_array();
$fWidowed80 = $row_fWidowed80[0];

//count 20-24 female status fDivorced
$comp_fDivorced24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 20 and Age <= 24);";
$result_fDivorced24 = $conn -> query($comp_fDivorced24);
$row2_fDivorced24 = $result_fDivorced24 -> fetch_array();
$fDivorced24 = $row2_fDivorced24[0];
//count 25-29 female status fDivorced
$comp_fDivorced29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 25 and Age <= 29);";
$result_fDivorced29 = $conn -> query($comp_fDivorced29);
$row_fDivorced29 = $result_fDivorced29 -> fetch_array();
$fDivorced29 = $row_fDivorced29[0];
//count 30-34 female status fDivorced
$comp_fDivorced34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 30 and Age <= 34);";
$result_fDivorced34 = $conn -> query($comp_fDivorced34);
$row_fDivorced34 = $result_fDivorced34 -> fetch_array();
$fDivorced34 = $row_fDivorced34[0];
//count 35-39 female status fDivorced
$comp_fDivorced39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 35 and Age <= 39);";
$result_fDivorced39 = $conn -> query($comp_fDivorced39);
$row_fDivorced39 = $result_fDivorced39 -> fetch_array();
$fDivorced39 = $row_fDivorced39[0];
//count 40-44 female status fDivorced
$comp_fDivorced44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 40 and Age <= 44);";
$result_fDivorced44 = $conn -> query($comp_fDivorced44);
$row_fDivorced44 = $result_fDivorced44 -> fetch_array();
$fDivorced44 = $row_fDivorced44[0];
//count 45-49 female status fDivorced
$comp_fDivorced49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 45 and Age <= 49);";
$result_fDivorced49 = $conn -> query($comp_fDivorced49);
$row_fDivorced49 = $result_fDivorced49 -> fetch_array();
$fDivorced49 = $row_fDivorced49[0];
//count 50-54 female status fDivorced
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$fDivorced54 = $row54[0];
//count 55-59 female status fDivorced
$comp_fDivorced59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 55 and Age <= 59);";
$result_fDivorced59 = $conn -> query($comp_fDivorced59);
$row_fDivorced59 = $result_fDivorced59 -> fetch_array();
$fDivorced59 = $row_fDivorced59[0];
//count 60-64 female status fDivorced
$comp_fDivorced64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 60 and Age <= 64);";
$result_fDivorced64 = $conn -> query($comp_fDivorced64);
$row_fDivorced64 = $result_fDivorced64 -> fetch_array();
$fDivorced64 = $row_fDivorced64[0];
//count 65-69 female status fDivorced
$comp_fDivorced69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 65 and Age <= 69);";
$result_fDivorced69 = $conn -> query($comp_fDivorced69);
$row_fDivorced69 = $result_fDivorced69 -> fetch_array();
$fDivorced69 = $row_fDivorced69[0];
//count 70-74 female status fDivorced
$comp_fDivorced74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 70 and Age <= 74);";
$result_fDivorced74 = $conn -> query($comp_fDivorced74);
$row_fDivorced74 = $result_fDivorced74 -> fetch_array();
$fDivorced74 = $row_fDivorced74[0];
//count 75-79 female status fDivorced
$comp_fDivorced79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 75 and Age <= 79);";
$result_fDivorced79 = $conn -> query($comp_fDivorced79);
$row_fDivorced79 = $result_fDivorced79 -> fetch_array();
$fDivorced79 = $row_fDivorced79[0];
//count 80-OVER female status fDivorced
$comp_fDivorced80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='female' and civilstatus = 'Divorced' and (Age >= 80);";
$result_fDivorced80 = $conn -> query($comp_fDivorced80);
$row_fDivorced80 = $result_fDivorced80 -> fetch_array();
$fDivorced80 = $row_fDivorced80[0];

//count 20-24 male status single
$comp_m24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 20 and Age <= 24);";
$result_m24 = $conn -> query($comp_m24);
$row2_m24 = $result_m24 -> fetch_array();
$m24 = $row2_m24[0];
//count 25-29 male status single
$comp_m29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 25 and Age <= 29);";
$result_m29 = $conn -> query($comp_m29);
$row_m29 = $result_m29 -> fetch_array();
$m29 = $row_m29[0];
//count 30-34 male status single
$comp_m34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 30 and Age <= 34);";
$result_m34 = $conn -> query($comp_m34);
$row_m34 = $result_m34 -> fetch_array();
$m34 = $row_m34[0];
//count 35-39 male status single
$comp_m39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 35 and Age <= 39);";
$result_m39 = $conn -> query($comp_m39);
$row_m39 = $result_m39 -> fetch_array();
$m39 = $row_m39[0];
//count 40-44 male status single
$comp_m44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 40 and Age <= 44);";
$result_m44 = $conn -> query($comp_m44);
$row_m44 = $result_m44 -> fetch_array();
$m44 = $row_m44[0];
//count 45-49 male status single
$comp_m49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 45 and Age <= 49);";
$result_m49 = $conn -> query($comp_m49);
$row_m49 = $result_m49 -> fetch_array();
$m49 = $row_m49[0];
//count 50-54 male status single
$comp_m54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 50 and Age <= 54);";
$result_m54 = $conn -> query($comp_m54);
$row_m54 = $result_m54 -> fetch_array();
$m54 = $row_m54[0];
//count 55-59 male status single
$comp_m59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 55 and Age <= 59);";
$result_m59 = $conn -> query($comp_m59);
$row_m59 = $result_m59 -> fetch_array();
$m59 = $row_m59[0];
//count 60-64 male status single
$comp_m64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 60 and Age <= 64);";
$result_m64 = $conn -> query($comp_m64);
$row_m64 = $result_m64 -> fetch_array();
$m64 = $row_m64[0];
//count 65-69 male status single
$comp_m69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 65 and Age <= 69);";
$result_m69 = $conn -> query($comp_m69);
$row_m69 = $result_m69 -> fetch_array();
$m69 = $row_m69[0];
//count 70-74 male status single
$comp_m74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 70 and Age <= 74);";
$result_m74 = $conn -> query($comp_m74);
$row_m74 = $result_m74 -> fetch_array();
$m74 = $row_m74[0];
//count 75-79 male status single
$comp_m79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 75 and Age <= 79);";
$result_m79 = $conn -> query($comp_m79);
$row_m79 = $result_m79 -> fetch_array();
$m79 = $row_m79[0];
//count 80-OVER male status single
$comp_m80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Single' and (Age >= 80);";
$result_m80 = $conn -> query($comp_m80);
$row_m80 = $result_m80 -> fetch_array();
$m80 = $row_m80[0];

//count 20-24 male status Married
$comp_married24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 20 and Age <= 24);";
$result_married24 = $conn -> query($comp_married24);
$row2_married24 = $result_married24 -> fetch_array();
$married24 = $row2_married24[0];
//count 25-29 male status Married
$comp_married29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 25 and Age <= 29);";
$result_married29 = $conn -> query($comp_married29);
$row_married29 = $result_married29 -> fetch_array();
$married29 = $row_married29[0];
//count 30-34 male status Married
$comp_married34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 30 and Age <= 34);";
$result_married34 = $conn -> query($comp_married34);
$row_married34 = $result_married34 -> fetch_array();
$married34 = $row_married34[0];
//count 35-39 male status Married
$comp_married39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 35 and Age <= 39);";
$result_married39 = $conn -> query($comp_married39);
$row_married39 = $result_married39 -> fetch_array();
$married39 = $row_married39[0];
//count 40-44 male status Married
$comp_married44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 40 and Age <= 44);";
$result_married44 = $conn -> query($comp_married44);
$row_married44 = $result_married44 -> fetch_array();
$married44 = $row_married44[0];
//count 45-49 male status Married
$comp_married49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 45 and Age <= 49);";
$result_married49 = $conn -> query($comp_married49);
$row_married49 = $result_married49 -> fetch_array();
$married49 = $row_married49[0];
//count 50-54 male status Married
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$married54 = $row54[0];
//count 55-59 male status Married
$comp_married59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 55 and Age <= 59);";
$result_married59 = $conn -> query($comp_married59);
$row_married59 = $result_married59 -> fetch_array();
$married59 = $row_married59[0];
//count 60-64 male status Married
$comp_married64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 60 and Age <= 64);";
$result_married64 = $conn -> query($comp_married64);
$row_married64 = $result_married64 -> fetch_array();
$married64 = $row_married64[0];
//count 65-69 male status Married
$comp_married69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 65 and Age <= 69);";
$result_married69 = $conn -> query($comp_married69);
$row_married69 = $result_married69 -> fetch_array();
$married69 = $row_married69[0];
//count 70-74 male status Married
$comp_married74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 70 and Age <= 74);";
$result_married74 = $conn -> query($comp_married74);
$row_married74 = $result_married74 -> fetch_array();
$married74 = $row_married74[0];
//count 75-79 male status Married
$comp_married79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 75 and Age <= 79);";
$result_married79 = $conn -> query($comp_married79);
$row_married79 = $result_married79 -> fetch_array();
$married79 = $row_married79[0];
//count 80-OVER male status Married
$comp_married80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Married' and (Age >= 80);";
$result_married80 = $conn -> query($comp_married80);
$row_married80 = $result_married80 -> fetch_array();
$married80 = $row_married80[0];

//count 20-24 male status Widowed
$comp_Widowed24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 20 and Age <= 24);";
$result_Widowed24 = $conn -> query($comp_Widowed24);
$row2_Widowed24 = $result_Widowed24 -> fetch_array();
$Widowed24 = $row2_Widowed24[0];
//count 25-29 male status Widowed
$comp_Widowed29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 25 and Age <= 29);";
$result_Widowed29 = $conn -> query($comp_Widowed29);
$row_Widowed29 = $result_Widowed29 -> fetch_array();
$Widowed29 = $row_Widowed29[0];
//count 30-34 male status Widowed
$comp_Widowed34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 30 and Age <= 34);";
$result_Widowed34 = $conn -> query($comp_Widowed34);
$row_Widowed34 = $result_Widowed34 -> fetch_array();
$Widowed34 = $row_Widowed34[0];
//count 35-39 male status Widowed
$comp_Widowed39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 35 and Age <= 39);";
$result_Widowed39 = $conn -> query($comp_Widowed39);
$row_Widowed39 = $result_Widowed39 -> fetch_array();
$Widowed39 = $row_Widowed39[0];
//count 40-44 male status Widowed
$comp_Widowed44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 40 and Age <= 44);";
$result_Widowed44 = $conn -> query($comp_Widowed44);
$row_Widowed44 = $result_Widowed44 -> fetch_array();
$Widowed44 = $row_Widowed44[0];
//count 45-49 male status Widowed
$comp_Widowed49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 45 and Age <= 49);";
$result_Widowed49 = $conn -> query($comp_Widowed49);
$row_Widowed49 = $result_Widowed49 -> fetch_array();
$Widowed49 = $row_Widowed49[0];
//count 50-54 male status Widowed
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$Widowed54 = $row54[0];
//count 55-59 male status Widowed
$comp_Widowed59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 55 and Age <= 59);";
$result_Widowed59 = $conn -> query($comp_Widowed59);
$row_Widowed59 = $result_Widowed59 -> fetch_array();
$Widowed59 = $row_Widowed59[0];
//count 60-64 male status Widowed
$comp_Widowed64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 60 and Age <= 64);";
$result_Widowed64 = $conn -> query($comp_Widowed64);
$row_Widowed64 = $result_Widowed64 -> fetch_array();
$Widowed64 = $row_Widowed64[0];
//count 65-69 male status Widowed
$comp_Widowed69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 65 and Age <= 69);";
$result_Widowed69 = $conn -> query($comp_Widowed69);
$row_Widowed69 = $result_Widowed69 -> fetch_array();
$Widowed69 = $row_Widowed69[0];
//count 70-74 male status Widowed
$comp_Widowed74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 70 and Age <= 74);";
$result_Widowed74 = $conn -> query($comp_Widowed74);
$row_Widowed74 = $result_Widowed74 -> fetch_array();
$Widowed74 = $row_Widowed74[0];
//count 75-79 male status Widowed
$comp_Widowed79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 75 and Age <= 79);";
$result_Widowed79 = $conn -> query($comp_Widowed79);
$row_Widowed79 = $result_Widowed79 -> fetch_array();
$Widowed79 = $row_Widowed79[0];
//count 80-OVER male status Widowed
$comp_Widowed80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Widowed' and (Age >= 80);";
$result_Widowed80 = $conn -> query($comp_Widowed80);
$row_Widowed80 = $result_Widowed80 -> fetch_array();
$Widowed80 = $row_Widowed80[0];
//count 20-24 male status Divorced
$comp_Divorced24 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 20 and Age <= 24);";
$result_Divorced24 = $conn -> query($comp_Divorced24);
$row2_Divorced24 = $result_Divorced24 -> fetch_array();
$Divorced24 = $row2_Divorced24[0];
//count 25-29 male status Divorced
$comp_Divorced29 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 25 and Age <= 29);";
$result_Divorced29 = $conn -> query($comp_Divorced29);
$row_Divorced29 = $result_Divorced29 -> fetch_array();
$Divorced29 = $row_Divorced29[0];
//count 30-34 male status Divorced
$comp_Divorced34 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 30 and Age <= 34);";
$result_Divorced34 = $conn -> query($comp_Divorced34);
$row_Divorced34 = $result_Divorced34 -> fetch_array();
$Divorced34 = $row_Divorced34[0];
//count 35-39 male status Divorced
$comp_Divorced39 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 35 and Age <= 39);";
$result_Divorced39 = $conn -> query($comp_Divorced39);
$row_Divorced39 = $result_Divorced39 -> fetch_array();
$Divorced39 = $row_Divorced39[0];
//count 40-44 male status Divorced
$comp_Divorced44 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 40 and Age <= 44);";
$result_Divorced44 = $conn -> query($comp_Divorced44);
$row_Divorced44 = $result_Divorced44 -> fetch_array();
$Divorced44 = $row_Divorced44[0];
//count 45-49 male status Divorced
$comp_Divorced49 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 45 and Age <= 49);";
$result_Divorced49 = $conn -> query($comp_Divorced49);
$row_Divorced49 = $result_Divorced49 -> fetch_array();
$Divorced49 = $row_Divorced49[0];
//count 50-54 male status Divorced
$comp54 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 50 and Age <= 54);";
$result54 = $conn -> query($comp54);
$row54 = $result54 -> fetch_array();
$Divorced54 = $row54[0];
//count 55-59 male status Divorced
$comp_Divorced59 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 55 and Age <= 59);";
$result_Divorced59 = $conn -> query($comp_Divorced59);
$row_Divorced59 = $result_Divorced59 -> fetch_array();
$Divorced59 = $row_Divorced59[0];
//count 60-64 male status Divorced
$comp_Divorced64 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 60 and Age <= 64);";
$result_Divorced64 = $conn -> query($comp_Divorced64);
$row_Divorced64 = $result_Divorced64 -> fetch_array();
$Divorced64 = $row_Divorced64[0];
//count 65-69 male status Divorced
$comp_Divorced69 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 65 and Age <= 69);";
$result_Divorced69 = $conn -> query($comp_Divorced69);
$row_Divorced69 = $result_Divorced69 -> fetch_array();
$Divorced69 = $row_Divorced69[0];
//count 70-74 male status Divorced
$comp_Divorced74 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 70 and Age <= 74);";
$result_Divorced74 = $conn -> query($comp_Divorced74);
$row_Divorced74 = $result_Divorced74 -> fetch_array();
$Divorced74 = $row_Divorced74[0];
//count 75-79 male status Divorced
$comp_Divorced79 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 75 and Age <= 79);";
$result_Divorced79 = $conn -> query($comp_Divorced79);
$row_Divorced79 = $result_Divorced79 -> fetch_array();
$Divorced79 = $row_Divorced79[0];
//count 80-OVER male status Divorced
$comp_Divorced80 = "SELECT COUNT(user_id) FROM resident_table WHERE gender='male' and civilstatus = 'Divorced' and (Age >= 80);";
$result_Divorced80 = $conn -> query($comp_Divorced80);
$row_Divorced80 = $result_Divorced80 -> fetch_array();
$Divorced80 = $row_Divorced80[0];

//COUNT SINGLE TOTAL
$t24 = $fSingle24 + $m24;
$t29 = $fSingle29 + $m29;
$t34 = $fSingle34 + $m34;
$t39 = $fSingle39 + $m39;
$t44 = $fSingle44 + $m44;
$t49 = $fSingle49 + $m49;
$t54 = $fSingle54 + $m54;
$t59 = $fSingle59 + $m59;
$t64 = $fSingle64 + $m64;
$t69 = $fSingle69 + $m69;
$t74 = $fSingle74 + $m74;
$t79 = $fSingle79 + $m79;
$t80 = $fSingle80 + $m80;
$tm24 = $fMarried24 + $married24;
$tm29 = $fMarried29 + $married29;
$tm34 = $fMarried34 + $married34;
$tm39 = $fMarried39 + $married39;
$tm44 = $fMarried44 + $married44;
$tm49 = $fMarried49 + $married49;
$tm54 = $fMarried54 + $married54;
$tm59 = $fMarried59 + $married59;
$tm64 = $fMarried64 + $married64;
$tm69 = $fMarried69 + $married69;
$tm74 = $fMarried74 + $married74;
$tm79 = $fMarried79 + $married79;
$tm80 = $fMarried80 + $married80;
$tw24 = $fWidowed24 + $Widowed24;
$tw29 = $fWidowed29 + $Widowed29;
$tw34 = $fWidowed34 + $Widowed34;
$tw39 = $fWidowed39 + $Widowed39;
$tw44 = $fWidowed44 + $Widowed44;
$tw49 = $fWidowed49 + $Widowed49;
$tw54 = $fWidowed54 + $Widowed54;
$tw59 = $fWidowed59 + $Widowed59;
$tw64 = $fWidowed64 + $Widowed64;
$tw69 = $fWidowed69 + $Widowed69;
$tw74 = $fWidowed74 + $Widowed74;
$tw79 = $fWidowed79 + $Widowed79;
$tw80 = $fWidowed80 + $Widowed80;
$td24 = $fDivorced24 + $Divorced24;
$td29 = $fDivorced29 + $Divorced29;
$td34 = $fDivorced34 + $Divorced34;
$td39 = $fDivorced39 + $Divorced39;
$td44 = $fDivorced44 + $Divorced44;
$td49 = $fDivorced49 + $Divorced49;
$td54 = $fDivorced54 + $Divorced54;
$td59 = $fDivorced59 + $Divorced59;
$td64 = $fDivorced64 + $Divorced64;
$td69 = $fDivorced69 + $Divorced69;
$td74 = $fDivorced74 + $Divorced74;
$td79 = $fDivorced79 + $Divorced79;
$td80 = $fDivorced80 + $Divorced80;





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
						<td>$fSingle24</td>
						<td>$fMarried24</td>
						<td>$fWidowed24</td>
						<td>$fDivorced24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$fSingle29</td>
						<td>$fMarried29</td>
						<td>$fWidowed29</td>
						<td>$fDivorced29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$fSingle34</td>
						<td>$fMarried34</td>
						<td>$fWidowed34</td>
						<td>$fDivorced34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$fSingle39</td>
						<td>$fMarried39</td>
						<td>$fWidowed39</td>
						<td>$fDivorced39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$fSingle44</td>
						<td>$fMarried44</td>
						<td>$fWidowed44</td>
						<td>$fDivorced44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$fSingle49</td>
						<td>$fMarried49</td>
						<td>$fWidowed49</td>
						<td>$fDivorced49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$fSingle54</td>
						<td>$fMarried54</td>
						<td>$fWidowed54</td>
						<td>$fDivorced54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$fSingle59</td>
						<td>$fMarried59</td>
						<td>$fWidowed59</td>
						<td>$fDivorced59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$fSingle64</td>
						<td>$fMarried64</td>
						<td>$fWidowed64</td>
						<td>$fDivorced64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$fSingle69</td>
						<td>$fMarried69</td>
						<td>$fWidowed69</td>
						<td>$fDivorced69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$fSingle74</td>
						<td>$fMarried74</td>
						<td>$fWidowed74</td>
						<td>$fDivorced74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$fSingle79</td>
						<td>$fMarried79</td>
						<td>$fWidowed79</td>
						<td>$fDivorced79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$fSingle80</td>
						<td>$fMarried80</td>
						<td>$fWidowed80</td>
						<td>$fDivorced80</td>

					<tbody>
				  		<th>MALE</th>
						<th>Single</th>
						<th>Married</th>
						<th>Widowed</th>
						<th>Divorced</th>
					</tbody>
					<tr>
						<td>20-24</td>
						<td>$m24</td>
						<td>$married24</td>
						<td>$Widowed24</td>
						<td>$Divorced24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$m29</td>
						<td>$married29</td>
						<td>$Widowed29</td>
						<td>$Divorced29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$m34</td>
						<td>$married34</td>
						<td>$Widowed34</td>
						<td>$Divorced34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$m39</td>
						<td>$married39</td>
						<td>$Widowed39</td>
						<td>$Divorced39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$m44</td>
						<td>$married44</td>
						<td>$Widowed44</td>
						<td>$Divorced44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$m49</td>
						<td>$married49</td>
						<td>$Widowed49</td>
						<td>$Divorced49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$m54</td>
						<td>$married54</td>
						<td>$Widowed54</td>
						<td>$Divorced54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$m59</td>
						<td>$married59</td>
						<td>$Widowed59</td>
						<td>$Divorced59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$m64</td>
						<td>$married64</td>
						<td>$Widowed64</td>
						<td>$Divorced64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$m69</td>
						<td>$married69</td>
						<td>$Widowed69</td>
						<td>$Divorced69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$m74</td>
						<td>$married74</td>
						<td>$Widowed74</td>
						<td>$Divorced74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$m79</td>
						<td>$married79</td>
						<td>$Widowed79</td>
						<td>$Divorced79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$m80</td>
						<td>$married80</td>
						<td>$Widowed80</td>
						<td>$Divorced80</td>
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
						<td>$t24</td>
						<td>$tm24</td>
						<td>$tw24</td>
						<td>$td24</td>
				  	</tr>
					<tr>
						<td>25-29</td>
				  		<td>$t29</td>
						<td>$tm29</td>
						<td>$tw29</td>
						<td>$td29</td>
					</tr>

					<tr>
						<td>30-34</td>
				  		<td>$t34</td>
						<td>$tm34</td>
						<td>$tw34</td>
						<td>$td34</td>
					</tr>
					<tr>
						<td>35-39</td>
				  		<td>$t39</td>
						<td>$tm39</td>
						<td>$tw39</td>
						<td>$td39</td>
					</tr>					
					<tr>
						<td>40-44</td>
				  		<td>$t44</td>
						<td>$tm44</td>
						<td>$tw44</td>
						<td>$td44</td>
					</tr>
					<tr>
						<td>45-49</td>
				  		<td>$t49</td>
						<td>$tm49</td>
						<td>$tw49</td>
						<td>$td49</td>
					</tr>
					<tr>
						<td>50-54</td>
				  		<td>$t54</td>
						<td>$tm54</td>
						<td>$tw54</td>
						<td>$td54</td>
					</tr>
					<tr>
						<td>55-59</td>
				  		<td>$t59</td>
						<td>$tm59</td>
						<td>$tw59</td>
						<td>$td59</td>
					</tr>
					<tr>
						<td>60-64</td>
				  		<td>$t64</td>
						<td>$tm64</td>
						<td>$tw64</td>
						<td>$td64</td>
					</tr>
					<tr>
						<td>65-69</td>
				  		<td>$t69</td>
						<td>$tm69</td>
						<td>$tw69</td>
						<td>$td69</td>
					</tr>					
					<tr>
						<td>70-74</td>
				  		<td>$t74</td>
						<td>$tm74</td>
						<td>$tw74</td>
						<td>$td74</td>
					</tr>
					<tr>
						<td>75-79</td>
				  		<td>$t79</td>
						<td>$tm79</td>
						<td>$tw79</td>
						<td>$td79</td>
					</tr>
					<tr>
						<td>80 and over</td>
						<td>$t80</td>
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

    $dompdf->addInfo("Title", "Barangay Clearance");

    $dompdf->stream("BarangayClearance.pdf", ["Attachment" => 0]);
?>