<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Boxicons CDN Link -->
    <meta name="viewport" content="width=device-width, initial-scale1.0">
</head>
<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-building-house'></i>
                <div class="logo_name">E-Barangay</div>
            </div>
            <i class='bx bx-menu' id="btn_menu"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="../dashboard/dashboard.html">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../file_received/file_received.html">
                    <i class='bx bx-file' ></i>
                    <span class="links_name">File Received</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../announcement/announcement.html">
                    <i class='bx bx-notification' ></i>
                    <span class="links_name">Announcement</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="../configuration/configuration.html">
                    <i class='bx bx-cog' ></i>
                    <span class="links_name">Configuration</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="../icons/admin_pic.jpg">
                    <div class="name_type">
                        <div class="name">Bernard Mazo</div>
                        <div class="type">Admin</div>
                    </div>
                </div>
                <a href="../../Login_v10/index.html">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="resman_content">
        <div class="text">Resident Management > Residency Registration</div>
        <hr>
        <div class="content">
            <div class="resident_table">
                <div class="header">
                    <p>Application List</p>
                </div>
                <div class="filter">
                    <form >
                        <label>Filter: </label>
                        <select id="purok" name="purok">
                            <option value="p">All</option>
                            <option value="Purok 1">Purok 1</option>
                            <option value="Purok 2">Purok 2</option>
                            <option value="Purok 3">Purok 3</option>
                            <option value="Purok 4">Purok 4</option>
                        </select>
                    </form>
                </div>
                <div class="restab">
                    <table class="residents">
                        <thead>
						<tr>
                            <th>ID</th>
                            <th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Birthplace</th>
							<th>Civil Status</th>
                            <th>Birthday</th>
                            <th>Age</th>
							<th>Household ID</th>
							<th>Purok</th>
                            <th>Sitio</th>
                            <th>Street</th>
                            <th>Subdivision</th>
                            <th>Contact No.</th>
                            <th>E-mail</th>
                            <th>Religion</th>
                            <th>Occupation</th>
                            <th>Educational Attainment</th>
                            <th>Nationality</th>
                            <th>Disability</th> 
							<th>Action</th>
                        </tr>
						</thead>
						
						<tbody><?php
							$connection = new mysqli("localhost", "root", "", "bgy_system");
							
							$sql = "SELECT * FROM registration";
							$result = $connection -> query($sql);

							while($row = $result->fetch_assoc()) {
							
							echo "<tr>
						    	<td>". $row["id"] . "</td>
								<td>". $row["fname"] . "</td>
								<td>". $row["mname"] . "</td>
								<td>". $row["lname"] . "</td>
								<td>". $row["gender"] . "</td>
								<td>". $row["birthplace"] . "</td>
								<td>". $row["civilstatus"] . "</td>
								<td>". $row["birthday"] . "</td>
								<td>". $row["age"] . "</td>
								<td>". $row["unitnumber"] . "</td>
								<td>". $row["purok"] . "</td>
								<td>" .$row["sitio"] . "</td>
								<td>" .$row["street"] . "</td>
								<td>" .$row["subdivision"] . "</td>
								<td>" .$row["contactnumber"] . "</td>
								<td>" .$row["email"] . "</td>
								<td>" .$row["religion"] . "</td>
								<td>" .$row["occupation"] . "</td>
								<td>" .$row["educational"] . "</td>
								<td>" .$row["nationality"] . "</td>
								<td>" .$row["disability"] . "</td>
								<td><a class='edit' href='#' id=". $row["id"] . " onclick='openPedit()'><i class='bx bx-edit'></i></a></td>
								";
                                
                    
                               
						}
						?>
					</tr>
					</tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pedit" id="pedit">
            <h2>Application Details</h2>
            <div class="reg_form">
                <form action="/action_page.php">
                    <table style="width:100%">	
						<?php
						$connection = new mysqli("localhost", "root", "", "bgy_system");
						$query = "SELECT * FROM registration WHERE id = 1";
						$result = $connection -> query($sql);
							
						$row = $result->fetch_assoc();
						echo "<tr>
                            <td><b>First Name: </b>". $row["fname"] . "</td>
                            <td><b>Middle Name: </b>". $row["mname"] . "</td>
                            <td><b>Last Name: </b>". $row["lname"] . "</td>
                            <td><b>Gender: </b>". $row["gender"] . "</td>
                        </tr>
                        <tr>
                            <td><b>Place Birth: </b>". $row["birthplace"] . "</td>
                            <td><b>Household ID: </b>". $row["unitnumber"] . "</td>
                            <td><b>Birthday: </b>". $row["birthday"] . "</td>
                            <td><b>Age: </b>". $row["age"] . "</td>
                        </tr>
                        <tr>
                            <td colspan='2'><b>Address: </b>". $row["birthplace"] . "</td>
                            <td><b>Purok: </b>". $row["purok"] . "</td>
                            <td><b>Civil Status: </b>". $row["civilstatus"] . "</td>
                        <tr>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Religion</th>
                            <th>Occupation</th>
                        </tr>
                        <tr>
                            <td>" .$row["contactnumber"] . "</td>
                            <td>" .$row["email"] . "</td>
                            <td>" .$row["religion"] . "</td>
                            <td>" .$row["occupation"] . "</td>
                        </tr>
                        <tr>
                            <td colspan='2'><b>Highest Educational Attainment: </b>College</td>
                            <td><b>Nationality: </b>" .$row["nationality"] . "</td>
                            <td><b>Disability: </b>" .$row["disability"] . "</td>
                        </tr>
                        <tr>
                            <th colspan='4'>Valid ID</th>
                        </tr>
                        <tr>
                            <td colspan='4'>
                                <img src='../icons/sample.jpg' style='width: 100%;'>
                            </td>
						";
						?>
                        </tr>
                    </table>
                </form>
            </div>
            <button type='button' class='save' onclick='closePedit()'>Accept</button>
            <button type='button' class='cancel' onclick='closePedit()'>Cancel</button>
        </div>
    </div>


    <script>
        let pedit = document.getElementById("pedit");

        function openPedit(){
            pedit.classList.add("open-pedit");
        }

        function closePedit(){
            pedit.classList.remove("open-pedit");
        }
    </script>
    <script>
        let padd = document.getElementById("padd");

        function openPadd(){
            padd.classList.add("open-padd");
        }

        function closePadd(){
            padd.classList.remove("open-padd");
        }
    </script>
    <script>
        let btn_menu = document.querySelector("#btn_menu");
        let sidebar = document.querySelector(".sidebar");

        btn_menu.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>