<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "control_budget";
    $con = mysqli_connect($host, $user, $password, $database) or die(mysqli_errno($con));
    session_start();
?>