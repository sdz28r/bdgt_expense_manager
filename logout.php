<?php
    session_start();
    session_unset();
    session_destroy();
    header('location: index.php');
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Logout Page</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>