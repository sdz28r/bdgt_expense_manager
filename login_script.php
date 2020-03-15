<?php
    require 'includes/common.php';
    
    $login_email = mysqli_real_escape_string($con, $_POST['loginEmail']);
    $login_password = mysqli_real_escape_string($con, $_POST['loginPassword']);
    $login_password = md5($login_password);
    
    $login_query = "select * from users where email = '$login_email'";
    echo "User login in between";
    $login_submit = mysqli_query($con, $login_query) or die(mysqli_errno($con));
    $row = mysqli_fetch_array($login_submit);
    $num = mysqli_num_rows($login_submit);
    
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
        if($num < 1){
            echo "<script>alert('User with this email address does not exist'); window.location = 'login.php'; </script>";
        } else{
            echo "<script>alert('Invalid email address or password'); window.location = 'login.php'; </script>";
        }
        exit ;
    }
?>