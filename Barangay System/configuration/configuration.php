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
    <div class="sidebar" style="background: <?php
        include("../../phpfiles/bgy_info.php");
        echo $row[1];
    ?>"> 
    
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-building-house'></i>
                <div class="logo_name">E-Barangay</div>
            </div>
            <i class='bx bx-menu' id="btn_menu"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="../dashboard/dashboard.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
            <li>
                <a href="#">
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
                <a href="#">
                    <i class='bx bx-cog' ></i>
                    <span class="links_name">Configuration</span>
                </a>
                <!--<span class="tooltip">Dashboard</span>-->
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile" style="background: <?php
                include("../../phpfiles/bgy_info.php");
                echo $row[1];
            ?>">
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
    <div class="configuration_content">
        <div class="text">Configuration</div>
        <hr>
        <br>
        <div style = "text-align: center;">
        <img src="uploads/<?php
            include("../../phpfiles/bgy_info.php");
            echo $row[2];
        ?>" width = "100" heigh ="100">
        </div>
        <div class="content">
            <div class="files">
                <h2>Theme Color</h2>
                <div class="file">
                    <div class="box">
                        <form action="color_change.php" method="post">
                        <table>
                            <tr>
                                <td><p>Primary Color</p></td>
                                <td><input type="color" name="prime" value="<?php
                                    include("../../phpfiles/bgy_info.php");
                                    echo $row[1];
                                    ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="save" value="Save"></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                <h2>Logo</h2>
                <div class="file">
                    <div class="box">
                        <form action="change_logo.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><p>Barangay Logo</p></td>
                                <td><input type="file" name="logo"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="upload" value="Upload"></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                <h2>Barangay Information</h2>
                <form action="update_bgy_info.php" method="post">
                    <p class="text" style="padding-left: 30px">Barangay Name/Number</p>
                    <div class="file">
                        <div class="box">
                            <table>
                                <tr>
                                    <input type="text" name= "bgy_name" value="<?php
                                        include("../../phpfiles/bgy_info.php");
                                        echo $row[3]
                                    ?>">
                                </tr>
                            </table>
                        </div>
                    </div>
                    <p class="text" style="padding-left: 30px">Mission</p>
                    <div class="file">
                        <div class="box">
                            <table>
                                <tr>
                                    <textarea name= "mission"><?php
                                        include("../../phpfiles/bgy_info.php");
                                        echo $row[5]
                                    ?></textarea>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <p class="text" style="padding-left: 30px">Vision</p>
                    <div class="file">
                        <div class="box">
                            <table>
                                <tr>
                                    <textarea name= "vision"><?php
                                        include("../../phpfiles/bgy_info.php");
                                        echo $row[4]
                                    ?></textarea>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="BI_save" value="Save"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
                <form action="save_module.php" method="POST">
                <h2>Modules</h2>
                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                                <td><p>Case Management</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="Case Management" <?php
                                        include('modules_available.php');
                                        if($availability[0] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><p>Resident Management</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="Resident Management" <?php
                                        include('modules_available.php');
                                        if($availability[1] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                  </label></td>
                            </tr>
                            <tr>
                                <td><p>Healthcare Center</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="Healthcare Center" <?php
                                        include('modules_available.php');
                                        if($availability[2] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                  </label></td>
                            </tr>
                            <tr>
                                <td><p>Request Verification</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="Request Verification" <?php
                                        include('modules_available.php');
                                        if($availability[3] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                  </label></td>
                            </tr>
                            <tr>
                                <td><p>Official Management</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="Official Management" <?php
                                        include('modules_available.php');
                                        if($availability[4] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                  </label></td>
                            </tr>
                            <tr>
                                <td><p>User Management</p></td>
                                <td><label class="switch">
                                    <input type="checkbox" name="modules[]" value="User Management" <?php
                                        include('modules_available.php');
                                        if($availability[5] == 'yes'){
                                            echo 'checked';
                                        }
                                    ?>>
                                    <span class="slider round"></span>
                                  </label></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="save_module" value="save"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                </form>
                <h2>Resident's Address</h2>

                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                                <td><p>Puroks</p></td>
                                <td><p>Sitios</p></td>
                                <td><p>Streets</p></td>
                                <td><p>Subdivisions</p></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <table>
                                    <?php
                                        include('address_field_list.php');
                                        while($row = $result -> fetch_array()){

                                        if($row["purok"] != ''){ ?>

                                        <form action="delete_field_list.php" method="post">
                                            <tr>
                                            <td><?php echo $row["purok"]; ?></td>
                                            <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                            <td><input type='submit' name='delete_purok' value='Delete'></td>
                                            </tr>
                                        </form>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td style="vertical-align: top;">
                                    <table>
                                    <?php
                                        include('address_field_list.php');
                                        while($row = $result -> fetch_array()){

                                        if($row["sitio"] != ''){ ?>
                                            <form action="delete_field_list.php" method="post">
                                                <tr>
                                                <td><?php echo $row["sitio"]; ?></td>
                                                <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                <td><input type='submit' name='delete_sitio' value='Delete'></td>
                                                </tr>
                                            </form>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td style="vertical-align: top;">
                                    <table>
                                    <?php
                                        include('address_field_list.php');

                                        while($row = $result -> fetch_array()){

                                        if($row["street"] != ''){ ?>
                                            <form action="delete_field_list.php" method="post">
                                                <tr>
                                                <td><?php echo $row["street"]; ?></td>
                                                <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                <td><input type='submit' name='delete_street' value='Delete'></td>
                                                </tr>
                                            </form>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td style="vertical-align: top;">
                                    <table>
                                    <?php
                                        include('address_field_list.php');
                                        while($row = $result -> fetch_array()){

                                        if($row["subdivision"] != ''){ ?>
                                            <form action="delete_field_list.php" method="post">
                                                <tr>
                                                <td><?php echo $row["subdivision"]; ?></td>
                                                <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                <td><input type='submit' name='delete_subdivision' value='Delete'></td>
                                                </tr>
                                            </form>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            <form action="add_field_list.php" method="post">
                                <td><input type="text" name= "purok" placeholder="enter purok name...">
                                <input type="submit" name="add_purok" value="Add"></td>

                                <td><input type="text" name= "sitio" placeholder="enter sitio name...">
                                <input type="submit" name="add_sitio" value="Add"></td>

                                <td><input type="text" name= "street" placeholder="enter street name...">
                                <input type="submit" name="add_street" value="Add"></td>
                                
                                <td><input type="text" name= "subdivision" placeholder="enter subdivision name...">
                                <input type="submit" name="add_subdivision" value="Add"></td>
                            </form>
                            </tr>
                        </table>
                        <?php
                            $empty_records = array();

                            include('address_field_list.php');
                            while($row = $result -> fetch_array()){
                                if($row['purok'] == '' && $row['sitio'] == '' && $row['street'] == '' && $row['subdivision'] == ''){
                                    array_push($empty_records,$row['id']);
                                }
                            }

                            foreach($empty_records as $emp_rec){
                                $query = "DELETE FROM address_fields WHERE id = $emp_rec;";
                                $result = $conn -> query($query);
                            }
                        ?>
                            <!--<?php
                                include('address_field_list.php');
                                while($row = $result -> fetch_array()){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if($row["sitio"] != ''){ ?>
                                                <table>
                                                <form action="delete_field_list.php" method="post">
                                                <td><?php echo $row["sitio"]; ?></td>
                                                <input type="hidden" name = "id" value = "<?php echo $row['id']?>">
                                                <td><input type='submit' name='delete_sitio' value='Delete'></td>
                                                </form>
                                                </table>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            -->
                    </div>
                </div>
                <!--
                <h2>Record Attributes</h2>
                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <h2>Complaints Nature</h2>
                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                                <input type="text" placeholder="Nature 1...">
                                <input type="text" placeholder="Nature 2...">
                                <input type="text" placeholder="Nature 3...">
                                <input type="text" placeholder="Nature 4...">
                                <input type="text" placeholder="Nature 5...">
                            </tr>
                        </table>
                    </div>
                </div>
                <h2>Suggestion Category</h2>
                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                                <input type="text" placeholder="Category 1...">
                                <input type="text" placeholder="Category 2...">
                                <input type="text" placeholder="Category 3...">
                                <input type="text" placeholder="Category 4...">
                                <input type="text" placeholder="Category 5...">
                            </tr>
                        </table>
                    </div>
                </div>
                <p class="text" style="padding-left: 30px">Goals</p>
                <div class="file">
                    <div class="box">
                        <table>
                            <tr>
                                <textarea></textarea>
                            </tr>
                        </table>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>

    <script>
        let btn_menu = document.querySelector("#btn_menu");
        let sidebar = document.querySelector(".sidebar");

        btn_menu.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>