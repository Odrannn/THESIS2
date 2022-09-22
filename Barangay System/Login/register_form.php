<form action="add_registration.php" method="post" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register Residency</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name..">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name">
                    </div>
                    <div class="col-md">
                        <h6 class="mb-2 pb-1">Gender: </h6>
                        
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                            value="female" />
                        <label class="form-check-label" for="femaleGender">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                            value="male" />
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
                        <input class="form-control" type="text" id="birthplace" name="birthplace" placeholder="Place of Birth">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="date" id="date" name="birthday">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="number" id="lname" name="age" placeholder="Age">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="civilstatus">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="address" name="unitnumber" placeholder="Unit Number">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="purok">
                            <option value="1">--Select Purok--</option>
                            <?php 
                            include("../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["purok"] != ''){ ?>
                                    <option value="<?php echo $row['purok'];?>"><?php echo $row['purok'];?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="sitio">
                            <option value="1">--Select Sitio--</option>
                            <?php 
                            include("../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["sitio"] != ''){ ?>
                                    <option value="<?php echo $row['sitio'];?>"><?php echo $row['sitio'];?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" name="street">
                            <option value="1">--Select Street--</option>
                            <?php 
                            include("../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["street"] != ''){ ?>
                                    <option value="<?php echo $row['street'];?>"><?php echo $row['street'];?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <select class="form-control" name="subdivision">
                            <option value="1">--Select Subdivision--</option>
                            <?php 
                            include("../phpfiles/address_fields.php");
                            while($row = $result -> fetch_array()) {
                                if($row["subdivision"] != ''){ ?>
                                    <option value="<?php echo $row['subdivision'];?>"><?php echo $row['subdivision'];?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" name="contactnumber" placeholder="09...">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="religion">
                            <option value="Roman Catholic">Roman Catholic</option>
                            <option value="Islam">Islam</option>
                            <option value="Evangelicals (PCEC)">Evangelicals (PCEC)</option>
                            <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                            <option value="Non-Roman Catholic and Protestant">Non-Roman Catholic and Protestant (NCCP)</option>
                            <option value="Aglipayan">Aglipayan</option>
                            <option value="Seventh-day Adventist">Seventh-day Adventist</option>
                            <option value="Bible Baptist Church">Bible Baptist Church</option>
                            <option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
                            <option value="Jehovah''''s Witnesses">Jehovah's Witnesses</option>
                            <option value="None">None</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="occupation" name="occupation" placeholder="Occupation">
                    </div>
                    <div class="col-md pt-2">
                        <select class="form-control" id="status" name="education">
                            <option value="Less Than Highschool">Less Than Highschool</option>
                            <option value="Highschool">Highschool</option>
                            <option value="College">College</option>
                            <option value="Bachelor''''s Degree">Bachelor's Degree</option>
                        </select>
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="mname" name="nationality" placeholder="Nationality">
                    </div>
                    <div class="col-md pt-2">
                        <input class="form-control" type="text" id="lname" name="disability" placeholder="Disability">
                        <p><small class="p-2">leave it blank if none.</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <p class="d-inline">Valid id</p><input class="form-control" type="file" name="validID">
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
            <input type="submit" class="btn btn-success" name="register" value="Register">
        </div>
    </div>
</form>

    