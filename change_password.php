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
        <title>Change Password Page</title>
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
                                    <h3>Change Password</h3>
                                </center>
                            </div>
                            <div class="panel-body">
                                <form action="change_password_script.php" method="post">
                                    <div class="form-group">
                                        <strong>Old Password</strong><br>
                                        <input type="password" required class="form-control" placeholder="Old Password" name="oldPassword">
                                    </div>
                                    <div class="form-group">
                                        <strong>New Password</strong><br>
                                        <input type="password" required class="form-control" placeholder="New Password (Min. 6 characters)" name="newPassword">
                                    </div>
                                    <div class="form-group">
                                        <strong>Confirm New Password</strong><br>
                                        <input type="password" required class="form-control" placeholder="Re-type New Password" name="confirmNewPassword">
                                    </div>
                                    <div class="form-group">
                                        <strong><button type="Submit" class="btn btn-primary buttonindex form-control"><b>Change</b></button></strong>
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
