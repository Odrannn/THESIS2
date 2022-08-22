<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Resident</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col pt-2">
                    <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name..">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name">
                </div>
                <div class="col">
                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                        value="option1" checked />
                    <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                        value="option2" />
                    <label class="form-check-label" for="maleGender">Male</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col pt-2">
                    <input class="form-control" type="text" id="birthplace" name="birthplace" placeholder="Place of Birth">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="date" id="date" name="birthday">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="number" id="lname" name="age" placeholder="Age">
                </div>
                <div class="col pt-2">
                    <select class="form-control" id="status" name="civilstatus">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Windowed">Windowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col pt-2">
                    <input class="form-control" type="text" id="address" name="unitnumber" placeholder="Unit Number">
                </div>
                <div class="col pt-2">

                    <select class="form-control" name="purok">
                        <option value="1">--Select Purok--</option>
                        <?php 
                        include("../../phpfiles/address_fields.php");
                        while($row = $result -> fetch_array()) {
                            if($row["purok"] != ''){ ?>?>
                                <option value="<? echo $row['purok']; php?>"><?php echo $row['purok'];?></option>
                        <?php }
                        } ?>
					</select>
                </div>
                <div class="col pt-2">
                    <select class="form-control" name="sitio">
                        <option value="1">--Select Sitio--</option>
                        <?php 
                        include("../../phpfiles/address_fields.php");
                        while($row = $result -> fetch_array()) {
                            if($row["sitio"] != ''){ ?>?>
                                <option value="<? echo $row['sitio']; php?>"><?php echo $row['sitio'];?></option>
                        <?php }
                        } ?>
					</select>
                </div>
                <div class="col pt-2">
                    <select class="form-control" name="street">
                        <option value="1">--Select Street--</option>
                        <?php 
                        include("../../phpfiles/address_fields.php");
                        while($row = $result -> fetch_array()) {
                            if($row["street"] != ''){ ?>?>
                                <option value="<? echo $row['street']; php?>"><?php echo $row['street'];?></option>
                        <?php }
                        } ?>
					</select>
                </div>
            </div>
            <div class="row">
                <div class="col pt-2">
                    <select class="form-control" id="purokno" name="subdivision">
                        <option value="1">--Select--</option>
                        <?php 
                        include("../../phpfiles/address_fields.php");
                        while($row = $result -> fetch_array()) {
                            if($row["subdivision"] != ''){ ?>?>
                                <option value="<? echo $row['subdivision']; php?>"><?php echo $row['subdivision'];?></option>
                        <?php }
                        } ?>
					</select>
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="number" id="fname" name="contactnumber" placeholder="+63">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="text" id="mname" name="email" placeholder="Email">
                </div>
                <div class="col pt-2">
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
                        <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
                        <option value="None">None</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col pt-2">
                    <input class="form-control" type="text" id="occupation" name="occupation" placeholder="Occupation">
                </div>
                <div class="col pt-2">
                    <select class="form-control" id="status" name="education">
                        <option value="Less Than Highschool">Less Than Highschool</option>
                        <option value="Hischool">Hischool</option>
                        <option value="College">College</option>
                        <option value="Bachelor's Degree">Bachelor's Degree</option>
                    </select>
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="text" id="mname" name="nationality" placeholder="Nationality">
                </div>
                <div class="col pt-2">
                    <input class="form-control" type="text" id="lname" name="disability" placeholder="Disability">
                    <p><small class="p-2">leave it blank if none.</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Add</button>
    </div>
</div>
    <?php
?>

    