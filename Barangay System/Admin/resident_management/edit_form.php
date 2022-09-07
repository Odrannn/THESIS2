<?php 
if(isset($_POST['userid'])){

    $conn = new mysqli("localhost", "root", "", "bgy_system");
    $query = "SELECT * FROM resident_table WHERE id = '".$_POST['userid']."'";
    $result = $conn -> query($query); 
    $row1 = mysqli_fetch_array($result)?>

    <form action="edit_resident.php" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Resident Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name.." value="<?php echo $row1["fname"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $row1["mname"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row1["lname"];?>">
                    </div>
                    <div class="col-md">
                        <h6 class="mb-2 pb-1">Gender: </h6>
                        
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                            value="female" <?php if($row1["gender"] == 'female'){ echo 'checked';}?> />
                        <label class="form-check-label" for="femaleGender">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                            value="male" <?php if($row1["gender"] == 'male'){ echo 'checked';}?>/>
                        <label class="form-check-label" for="maleGender">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="otherGender"
                            value="other" />
                        <label class="form-check-label" for="otherGender">Other</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="birthplace" name="birthplace" placeholder="Place of Birth" value="<?php echo $row1["birthplace"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="date" id="date" name="birthday" value="<?php echo $row1["birthday"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="number" id="lname" name="age" placeholder="Age" value="<?php echo $row1["age"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="civilstatus" value="<?php echo $row1["civilstatus"];?>">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Windowed">Windowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="address" name="unitnumber" placeholder="Unit Number" value="<?php echo $row1["unitnumber"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="purok">
                            <option value="1">--Select Purok--</option>
                            <?php 
                            include("../../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["purok"] != ''){ 
                                    if($row["purok"] == $row1["purok"]){?>
                                        <option value="<?php echo $row['purok'];?>" selected><?php echo $row['purok'];?></option>
                                    <?php
                                    }
                                    else {?>
                                        <option value="<?php echo $row['purok'];?>"><?php echo $row['purok'];?></option>
                            <?php   }
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="sitio">
                            <option value="1">--Select Sitio--</option>
                            <?php 
                            include("../../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["sitio"] != ''){ 
                                    if($row["sitio"] == $row1["sitio"]){?>
                                        <option value="<?php echo $row['sitio'];?>" selected><?php echo $row['sitio'];?></option>
                                    <?php
                                    }
                                    else {?>
                                        <option value="<?php echo $row['sitio'];?>"><?php echo $row['sitio'];?></option>
                            <?php   }
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="street">
                            <option value="1">--Select Street--</option>
                            <?php 
                            include("../../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["street"] != ''){
                                    if($row["street"] == $row1["street"]){?>
                                        <option value="<?php echo $row['street'];?>" selected><?php echo $row['street'];?></option>
                                    <?php
                                    }
                                    else {?>
                                        <option value="<?php echo $row['street'];?>"><?php echo $row['street'];?></option>
                            <?php   }
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <select class="form-control" name="subdivision">
                            <option value="1">--Select Subdivision--</option>
                            <?php 
                            include("../../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["subdivision"] != ''){ 
                                    if($row["subdivision"] == $row1["subdivision"]){?>
                                        <option value="<?php echo $row['subdivision'];?>" selected><?php echo $row['subdivision'];?></option>
                                    <?php
                                    }
                                    else {?>
                                        <option value="<?php echo $row['subdivision'];?>"><?php echo $row['subdivision'];?></option>
                            <?php   }
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" name="contactnumber" placeholder="+63" value="<?php echo $row1["contactnumber"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $row1["email"];?>">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="religion">
                            <option value="Roman Catholic" <?php if($row1["religion"] == "Roman Catholic"){ echo "selected"; }?>>Roman Catholic</option>
                            <option value="Islam" <?php if($row1["religion"] == "Islam"){ echo "selected"; }?>>Islam</option>
                            <option value="Evangelicals (PCEC)" <?php if($row1["religion"] == "Evangelicals (PCEC)"){ echo "selected"; }?>>Evangelicals (PCEC)</option>
                            <option value="Iglesia ni Cristo" <?php if($row1["religion"] == "Iglesia ni Cristo"){ echo "selected"; }?>>Iglesia ni Cristo</option>
                            <option value="Non-Roman Catholic and Protestant" <?php if($row1["religion"] == "Non-Roman Catholic and Protestant"){ echo "selected"; }?>>Non-Roman Catholic and Protestant (NCCP)</option>
                            <option value="Aglipayan" <?php if($row1["religion"] == "Aglipayan"){ echo "selected"; }?>>Aglipayan</option>
                            <option value="Seventh-day Adventist" <?php if($row1["religion"] == "Seventh-day Adventist"){ echo "selected"; }?>>Seventh-day Adventist</option>
                            <option value="Bible Baptist Church" <?php if($row1["religion"] == "Bible Baptist Church"){ echo "selected"; }?>>Bible Baptist Church</option>
                            <option value="United Church of Christ in the Philippines" <?php if($row1["religion"] == "United Church of Christ in the Philippines"){ echo "selected"; }?>>United Church of Christ in the Philippines</option>
                            <option value="Jehovah''s Witnesses" <?php if($row1["religion"] == "Jehovah's Witnesses"){ echo "selected"; }?>>Jehovah's Witnesses</option>
                            <option value="None" <?php if($row1["religion"] == "None"){ echo "selected"; }?>>None</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="occupation" name="occupation" placeholder="Occupation" value="<?php echo $row1['occupation'];?>">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="education">
                            <option value="Less Than Highschool" <?php if($row1["education"] == "Less Than Highschool"){ echo "selected"; }?>>Less Than Highschool</option>
                            <option value="Highschool" <?php if($row1["education"] == "Highschool"){ echo "selected"; }?>>Highschool</option>
                            <option value="College" <?php if($row1["education"] == "College"){ echo "selected"; }?>>College</option>
                            <option value="Bachelor''s Degree" <?php if($row1["education"] == "Bachelor's Degree"){ echo "selected"; }?>>Bachelor's Degree</option>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="mname" name="nationality" placeholder="Nationality" value="<?php echo $row1['nationality'];?>">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="lname" name="disability" placeholder="Disability" value="<?php echo $row1['disability'];?>">
                        <p><small class="p-2">leave it blank if none.</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="status">
                            <option value="active" <?php if($row1["status"] == "active"){ echo "selected"; }?>>Active</option>
                            <option value="inactive" <?php if($row1["status"] == "inactive"){ echo "selected"; }?>>Inactive</option>
                        </select>
                    </div>
                    <div class="col pt-2">
                        
                    </div>
                    <div class="col pt-2">
                        
                    </div>
                    <div class="col pt-2">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="resident_id" value="<?php echo $row1['id'];?>">
            <input type="submit" class="btn btn-success" name="edit_resident" value="Update">
        </div>
    </div>
    </form>
    <?php
} ?>

    