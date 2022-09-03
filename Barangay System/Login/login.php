
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body background="images/<?php
        include("../phpfiles/bgy_info.php");
        echo $row[7];
        ?>">
    
    <div class="login">

        <h1 class="text-center">Login</h1>
        
        <form action="login_account.php" method="post">
            <div class="form-group was-validated">
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" required>
                <div class="invalid-feedback">
                    Please enter your username
                </div>
            </div>
            <div class="form-group was-validated">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
                <div class="invalid-feedback">
                    Please enter your password
                </div>
            </div>
            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" id="check">
                <label class="form-check-label" for="check">Remember me</label>
            </div>
            <button type="button" class="btn btn-link p-0">Forgot Password?</button>
            <input class="btn btn-success w-100" type="submit" value="LOG IN">
        </form>
        <h6 class="d-inline align-middle">Don't have an account?</h6><button class="register btn btn-link p-0">Register Here</button>
    </div>
    <!--register Modal-->
    <div class="modal fade modal-xl" id="regModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
        </div>
    </div>
    <!-- register script-->
    <script>
        $(document).ready(function(){
            $('.register').click(function(){
                $.ajax({url: "register_form.php",
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#regModal').modal('show');
            });
        });
    </script>
</body>

</html>