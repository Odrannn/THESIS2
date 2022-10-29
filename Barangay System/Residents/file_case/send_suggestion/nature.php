<?php
session_start();

if(isset($_POST['nature'])){
    $nature = $_POST['nature'];
}

?>
<?php if($nature=="Other"){?>
<div class="col pt-2">
    <label class="pb-2" for="other">Enter Nature</label> 
    <input type ="text" class="form-control" id= "other" name= "other">
</div>  
<?php } ?>