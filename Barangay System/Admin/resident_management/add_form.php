<style>
.form-message{
    text-align: center;
    color: #162A83;
    padding: 10px 0;
    text-transform: capitalize;
    background: rgba(231, 235, 249, 1);
    font-size: 12px;
    display: none;
}

.form-message p {
    margin: 0;
}

.form-message p span{
    color: #980e
}
</style>
<form id= "myFORM">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name">
                            <label for="fname">First Name</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name">
                            <label for="mname">Middle Name</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name">
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="suffix" name="suffix" placeholder="Suffix">
                            <label for="suffix">Suffix (Jr, Sr, I, II, etc.)</label>
                            <p><small class="p-2">leave it blank if none.</small></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <h6 class="mb-2 pb-1">Gender: </h6>
                        
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                            value="female" checked/>
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
                        <div class="form-floating">
                            <input class="form-control" type="text" id="birthplace" name="birthplace" placeholder="Place of Birth">
                            <label for="birthplace">Place of Birth</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="date" id="date" name="birthday" >
                            <label for="date">Birthday</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="number" id="age" name="age" placeholder="Age" >
                            <label for="age">Age</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating"> 
                            <select class="form-control" id="status" name="civilstatus" >
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            <label for="status">Civil Status</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="unitnumber" name="unitnumber" placeholder="Unit Number" >
                            <label for="unitnumber">Unit Number</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="purok" id="purok">
                                <option value="">--Select Purok--</option>
                                <?php 
                                include("../../phpfiles/address_fields.php");
                                while($row = $result -> fetch_array()) {
                                    if($row["purok"] != ''){ ?>
                                        <option value="<?php echo $row['purok'];?>"><?php echo $row['purok'];?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="purok">Purok</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="sitio">
                                <option value="">--Select Sitio--</option>
                                <?php 
                                include("../../phpfiles/address_fields.php");
                                while($row = $result -> fetch_array()) {
                                    if($row["sitio"] != ''){ ?>
                                        <option value="<?php echo $row['sitio'];?>"><?php echo $row['sitio'];?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="sitio">Sitio</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="street">
                                <option value="">--Select Street--</option>
                                <?php 
                                include("../../phpfiles/address_fields.php");
                                while($row = $result -> fetch_array()) {
                                    if($row["street"] != ''){ ?>
                                        <option value="<?php echo $row['street'];?>"><?php echo $row['street'];?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="street">Street</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" name="subdivision">
                                <option value="">--Select Subdivision--</option>
                                <?php 
                                include("../../phpfiles/address_fields.php");
                                while($row = $result -> fetch_array()) {
                                    if($row["subdivision"] != ''){ ?>
                                        <option value="<?php echo $row['subdivision'];?>"><?php echo $row['subdivision'];?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="subdivision">Subdivision</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="number" id="contactnumber" name="contactnumber" placeholder="09...">
                            <label for="contactnumber">Contact number(09...)</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="email" name="email" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" id="religion" name="religion">
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
                            <label for="religion">Religion</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="occupation" name="occupation" placeholder="Occupation">
                            <label for="occupation">Occupation</label>
                            <p><small class="p-2">leave it blank if none.</small></p>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <select class="form-control" id="education" name="education">
                                <option value="Less Than Highschool">Less Than Highschool</option>
                                <option value="Highschool">Highschool</option>
                                <option value="College">College</option>
                                <option value="Bachelor''''s Degree">Bachelor's Degree</option>
                            </select>
                            <label for="education">Education</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="nationality" name="nationality" placeholder="Nationality">
                            <label for="nationality">Nationality</label>
                        </div>
                    </div>
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="disability" name="disability" placeholder="Disability">
                            <p><small class="p-2">leave it blank if none.</small></p>
                            <label for="disability">Disability</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-message"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="add" value="Add">
        </div>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function(){
        $("#myFORM").on('submit',function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "add_resident.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success:function(response){
                    $(".form-message").css("display", "block");

                    if(response.status == 1){
                        $("#myFORM")[0].reset();
                        $(".form-message").html('<p>' + response.message + '</p>')
                    } else {
                        $(".form-message").html('<p>' + response.message + '</p>')
                    }
                }
            });
        });
    });
</script>


    