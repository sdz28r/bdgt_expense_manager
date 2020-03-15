<?php
    require 'includes/common.php';
    
    
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    if(strlen($password) < 6){
        echo "<script>alert('Minimun 6 digits required for password'); window.location = 'signup.php'; </script>";
    }
    else if(is_nan($phone_number) || strlen($phone_number) != 10){
        echo "<script>alert('Not a valid phone number'); window.location = 'signup.php'; </script>";
    }
    else{
        $password = md5($password);
        $query = "select email from users where email = '$email'";
        $submit = mysqli_query($con, $query) or die(mysqli_errno($con));
        if(mysqli_num_rows($submit) > 0){
            echo "<script>alert('User with this email address already exists'); window.location = 'signup.php'; </script>";
            exit ;
        }
        else{
            $signup_query = "insert into users(name, email, password, phone_number) values('$name', '$email', '$password', '$phone_number')";
            $signup_submit = mysqli_query($con, $signup_query) or die(mysqli_errno($con));
            
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['id'] = mysqli_insert_id($con);

            if(isset($_SESSION['id'])){
                echo "<script>alert('User successfully registered'); window.location = 'home.php'; </script>";
                exit ;
            }

            if(!isset($_SESSION['id'])){
                header('location: signup.php');
                exit ;
            }
        }
    }
?>