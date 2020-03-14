<?php
    require 'includes/common.php';
    if(isset($_SESSION['id'])){
        header('location: home.php');
        exit ;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Index Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>
        <?php
            include 'includes/header.php';
        ?>
      
        <div id="banner_image">
            <div class="container">
                <center>
                    <div id="banner_content">
                        <h1>We help you control your Budget</h1>
                        <a class="btn btn-primary btn-lg buttonindex" href="login.php">Start Today</a>
                    </div>
                </center>
            </div>
        </div>
        
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>