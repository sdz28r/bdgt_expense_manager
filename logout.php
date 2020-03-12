<?php
    session_start();
    session_unset();
    session_destroy();
    header('location: index.php');
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Logout Page</title>
    </head>
    <body>
    </body>
</html>