<?php
    require 'includes/common.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Sign Up Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script> 
            function InvalidMsg(textbox) { 
                if (textbox.value === '') { 
                    textbox.setCustomValidity('Please enter the email address'); 
                } else if (textbox.validity.typeMismatch) { 
                    textbox.setCustomValidity('Please enter a valid email address of the format: abc@efg.xyz i.e. must include @ and .'); 
                } else { 
                    textbox.setCustomValidity(''); 
                } 
                return true; 
            } 
        </script> 
    </head>
    <body>
        <?php
            include 'includes/header.php';
        ?>
        
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-md-4 col-md-offset-4 col-xs-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: rgb(255, 255, 255);"> 
                                <center>
                                    <h3>Sign Up</h3>
                                </center>
                            </div>
                            <div class="panel-body">
                                <form action="signup_script.php" method="post">
                                    <div class="form-group">
                                        <strong>Name:</strong><br>
                                        <input type="text" required class="form-control" placeholder="Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <strong>Email:</strong><br>
                                        <input type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" class="form-control" placeholder="Enter Valid Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <strong>Password:</strong><br>
                                        <input type="password" class="form-control" placeholder="Password (Min. 6 characters)" name="password">
                                    </div>
                                    <div class="form-group">
                                        <strong>Phone Number:</strong><br>
                                        <input type="tel" required class="form-control lg" placeholder="Enter Valid Phone Number (Ex: 8448444853)" name="phoneNumber">
                                    </div>
                                    <div class="form-group">
                                        <strong><button type="Submit" class="btn btn-primary buttonindex form-control">Sign Up</button></strong>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
 
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>