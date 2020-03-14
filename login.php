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
        <title>Login Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                    <h3>Login</h3>
                                </center>
                            </div>
                            <div class="panel-body">
                                <form action="login_script.php" method="post">
                                    <div class="form-group">
                                        <strong>Email:</strong><br>
                                        <input type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" placeholder="Email" name="loginEmail">
                                    </div>
                                    <div class="form-group">
                                        <strong>Password:</strong><br>
                                        <input type="password" required pattern=".{6,}" class="form-control" placeholder="Password" name="loginPassword">
                                    </div>
                                    <div class="form-group">
                                        <strong><button type="Submit" class="btn btn-primary buttonindex form-control"><b>Login</b></button></strong>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <p>Don't have an account? <a href ='signup.php' style="text-decoration: none">Click here to Sign Up</a></p>
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