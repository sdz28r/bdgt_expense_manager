<?php
    require 'includes/common.php';
    
    $login_email = mysqli_real_escape_string($con, $_POST['loginEmail']);
    $login_password = mysqli_real_escape_string($con, $_POST['loginPassword']);
    $login_password = md5($login_password);
    
    $signup_query = "select * from users where email = '$login_email'";
    echo "User login in between";
    $signup_submit = mysqli_query($con, $signup_query) or die(mysqli_errno($con));
    $row = mysqli_fetch_array($signup_submit);
    
    if($login_password == $row['password']){
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['id'] = mysqli_insert_id($con);
    }
    
    if(isset($_SESSION['id'])){
        header('location: home.php');
        exit ;
    } else{
        header('location: login.php');
        exit ;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Script</title>
    </head>
    <body>
    </body>
</html>