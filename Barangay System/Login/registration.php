<?php
	session_start();
	$connection = new mysqli("localhost", "root", "", "bgy_system");
	$_SESSION['message']='';
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if($_POST['fname']=$_POST['fname']){
			
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$lname = $_POST['lname'];
			$gender = $_POST['gender'];
			$birthplace = $_POST['birthplace'];
			$civilstatus = $_POST['civilstatus'];
			$birthday = $_POST['birthday'];
			$age = $_POST['age'];
			$unitnumber = $_POST['unitnumber'];
			$purok = $_POST['purok'];
			$sitio = $_POST['sitio'];
			$street = $_POST['street'];
			$subdivision = $_POST['subdivision'];
			$contactnumber = $_POST['contactnumber'];
			$email = $_POST['email'];
			$religion = $_POST['religion'];
			$occupation = $_POST['occupation'];
			$educational = $_POST['educational'];
			$nationality = $_POST['nationality'];
			$disability = $_POST['disability'];
			$img_path= $_FILES['avatar']['name'];
			

			$fname=mysqli_real_escape_string($conn,$fname);
			$mname=mysqli_real_escape_string($conn,$mname);
			$lname=mysqli_real_escape_string($conn,$lname);
			$gender=mysqli_real_escape_string($conn,$gender);
			$birthplace=mysqli_real_escape_string($conn,$birthplace);
			$civilstatus=mysqli_real_escape_string($conn,$civilstatus);
			$birthday=mysqli_real_escape_string($conn,$birthday);
			$age=mysqli_real_escape_string($conn,$age);
			$unitnumber=mysqli_real_escape_string($conn,$unitnumber);
			$purok=mysqli_real_escape_string($conn,	$purok);
			$sitio=mysqli_real_escape_string($conn,$sitio);
			$street=mysqli_real_escape_string($conn,$street);
			$subdivision=mysqli_real_escape_string($conn,$subdivision);
			$contactnumber=mysqli_real_escape_string($conn,$contactnumber);
			$email=mysqli_real_escape_string($conn,$email);
			$religion=mysqli_real_escape_string($conn,$religion);
			$occupation=mysqli_real_escape_string($conn,$occupation);
			$educational=mysqli_real_escape_string($conn,$educational);
			$nationality=mysqli_real_escape_string($conn,$nationality);
			$disability=mysqli_real_escape_string($conn,$disability);
			$img_path=mysqli_real_escape_string($conn,$img_path);
	

			if(preg_match("!image!",$_FILES['avatar']['type'])){
				if(copy($_FILES['avatar']['tmp_name'],$img_path)){
					$_SESSION['contactnumber']=$contactnumber;
					$_SESSION['avatar']=$img_path;
					
					$sql="INSERT INTO registration(fname,mname,lname,gender,birthplace,civilstatus,birthday,age,unitnumber,purok,sitio,street,subdivision,contactnumber,email,religion,occupation,educational,nationality,disability,img_path,status)VALUES('$fname','$mname','$lname','$gender','$birthplace','$civilstatus','$birthday','$age','$unitnumber','$purok','$sitio','$street','$subdivision','$contactnumber','$email','$religion','$occupation','$educational','$nationality','$disability','$img_path','pending')";
					if(mysqli_query($conn,$sql)){
						$_SESSION['message']="Registration Successfull";
						header("location:index.php");
					}
					else{
						$_SESSION['message']="User could not be added to database!";
					}	
				} else {
					$_SESSION['message']="File Upload Failed!";
				}
			} else {
				$_SESSION['message']="Please upload only JPG, PNG, or GIF image!";
			}
		}
		else{
			$_SESSION['message']="Password did not match!";
		}
	}
?>



<html lang="en">
<head>
  
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('background.png');background-repeat: no-repeat;">
<div class="limiter">
	<div class="container-login100">
		<div class="reg_form" style="background-color:white;">
			<form action="" method="post" enctype="multipart/form-data" autocomplete="off" style="background-color:white;" >
				<span class="login100-form-title p-b-51" >
					REGISTRATION
				</span>
				<table style="width:100%">
					<tr>
						<th>First Name</td>
						<th>Middle Name</th>
						<th>Last Name</td>
						<th>Gender</td>
					</tr>
					<tr>
						<td><input for="fname" type="text" id="fname" name="fname" placeholder="First Name.."></td>
						<td><input for="mname" type="text" id="mname" name="mname" placeholder="Middle Name"></td>
						<td><input for="lname" type="text" id="lname" name="lname" placeholder="Last Name"></td>
						<td><label class="radio-inline">
                  <label for="male" class="radio-inline"
                    ><input
                      type="radio"
                      name="gender"
                      value="m"
                      id="male"
                    />Male</label
                  >
                  <label for="female" class="radio-inline"
                    ><input
                      type="radio"
                      name="gender"
                      value="f"
                      id="female"
                    />Female</label
                  >
                  <label for="others" class="radio-inline"
                    ><input
                      type="radio"
                      name="gender"
                      value="o"
                      id="others"
                    />Others</label
                  >
						</label>
						</td>
					</tr>
					<tr>
						<th>Place of Birth</td>
						<th>Civil Status</th>
						<th>Birthday</td>
						<th>Age</td>
					</tr>
					<tr>
						<td><input for="birthplace" type="text" id="birthplace" name="birthplace" placeholder="Place of Birth"></td>
						<td><select for="civilstatus" id="status" name="civilstatus">
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Windowed">Windowed</option>
							<option value="Divorced">Divorced</option>
							</select>
						</td>
						<td><input for="birthday" type="date" id="date" name="birthday"></td>
						<td><input for="age" type="number" id="lname" name="age" placeholder="Age"></td>
					</tr>
					<tr>
						<th>Full Address</th>
					</tr>
					<tr>
						<th>Unit Number</th>
						<th>Purok</th>
						<th>Sitio</th>
						<th>Street</th>
					</tr>
					<tr>
						<td><input for="unitnumber"type="text" id="address" name="unitnumber" placeholder="Unit Number"></td>
						<td><select for="purok" id="purokno" name="purok">
							<option value="1">--Select--</option>
							<option value="1">First street</option>
							<option value="2">Second Street</option>
							<option value="3">Third Street</option>
							</select></td>
						<td><select for="sitio" id="purokno" name="sitio">
							<option value="1">--Select--</option>
							<option value="Sitio 1">Sitio 1</option>
							<option value="Sitio 2">Sitio 2</option>
							<option value="Sitio 3">Sitio 3</option>
							</select></td>
						<td><select for="street" id="purokno" name="street">
							<option value="1">--Select--</option>
							<option value="Street 1">Street 1</option>
							<option value="Street 2">Street 2</option>
							<option value="Street 3">Street 3</option>
							</select></td>
					</tr>
					<tr>
						<th>Subdivision</th>
					</tr>
					<tr>
						<td><select for="subdivision" id="purokno" name="subdivision">
							<option value="1">--Select--</option>
							<option value="Subdivision 1">Subdivision 1</option>
							<option value="Subdivision 2">Subdivision 2</option>
							<option value="Subdivision 3">Subdivision 3</option>
							</select></td>
					</tr>
					<tr>
						<th>Contact Number</th>
						<th>Email</th>
						<th>Religion</th>
						<th>Occupation</th>
					</tr>
					<tr>
						<td><input for="contactnumber" type="number" id="fname" name="contactnumber" placeholder="+63"></td>
						<td><input for="email" type="text" id="mname" name="email" placeholder="Email"></td>
						<td><select for="religion" id="status" name="religion">
							<option value="Roman Catholic">Roman Catholic</option>
							<option value="Islam">Islam</option>
							<option value="Evangelicals (PCEC)">Evangelicals (PCEC)</option>
							<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
							<option value="Non-Roman Catholic and Protestant">Non-Roman Catholic and Protestant (NCCP)</option>
							<option value="Aglipayan">Aglipayan</option>
							<option value="Seventh-day Adventist">Seventh-day Adventist</option>
							<option value="Bible Baptist Church">Bible Baptist Church</option>
							<option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
							<option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
							<option value="None">None</option>
							</select></td>
						<td><input for="occupation" type="text" id="occupation" name="occupation" placeholder="Occupation"></td>
					</tr>
					<tr>
						<th>Educational Attainment</th>
						<th>Nationality</th>
						<th>Disability</th>
						<th>Valid ID</th>
					</tr>
					<tr>
						<td><select for="educational" id="status" name="educational">
							<option value="Less Than Highschool">Less Than Highschool</option>
							<option value="Hischool">Hischool</option>
							<option value="College">College</option>
							<option value="Bachelor's Degree">Bachelor's Degree</option>
							</select></td>
						<td><input for="nationality" type="text" id="mname" name="nationality" placeholder="Nationality"></td>
						<td><input for="disability" type="text" id="lname" name="disability" placeholder="Disability"></td>
						<td><input for="imgpath" type="file" id="imgpath" name="avatar" style="width:230px;"></td>
					</tr>
				</table>
				<div class ="consent">
					<d><b>DATA PRIVACY CONSENT</b></d>
					<br>
					<br>
					<p>
						By completing this form, I give permission for my data to be held in
						the E-barangay system database and agree that the system may process personal
						data relating to me for personnel, administration and/or management purposes.
					</p>
					<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" required>
  					<label for="vehicle1"><p>I agree with the statement above</p></label><br>
				</div>
				<div id="confirmbtn">
				<a><button type="submit" name="submit" style="width:120px;height:50px;color:white;margin-right:10px;">CONFIRM</button></a>
				
				<a><button type="button" style="width:120px;height:50px;color:white;">RESET</button></a>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
