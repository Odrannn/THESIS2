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

$tsex5 = $agem5 = $agef5;
$tsex9 = $agem9 = $agef9;
$tsex14 = $agem14 = $agef14;
$tsex19 = $agem19 = $agef19;
$tsex24 = $agem24 = $agef24;
$tsex29 = $agem29 = $agef29;
$tsex34 = $agem34 = $agef34;
$tsex39 = $agem39 = $agef39;
$tsex44 = $agem44 = $agef44;
$tsex49 = $agem49 = $agef49;
$tsex54 = $agem54 = $agef54;
$tsex59 = $agem59 = $agef59;
$tsex64 = $agem64 = $agef64;
$tsex69 = $agem69 = $agef69;
$tsex74 = $agem74 = $agef74;
$tsex79 = $agem79 = $agef79;
$tsex84 = $agem84 = $age84;
$tsex85 = $agem85 = $agef85;

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
		$mage80 = $mage80 + 1;
	} else{
		$mage80 = $mage80 + 1;
	} 
}




