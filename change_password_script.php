<?php
    require 'includes/common.php';
    
    $old_password = mysqli_real_escape_string($con, $_POST['oldPassword']);
    $old_password = md5($old_password);

    $new_password = mysqli_real_escape_string($con, $_POST['newPassword']);
    $password = $new_password;
    $new_password = md5($new_password);
    $confirm_new_password = mysqli_real_escape_string($con, $_POST['confirmNewPassword']);
    $confirm_new_password = md5($confirm_new_password);
    
    $email = $_SESSION['email'];
    $change_password_query = "select password from users where email = '$email'";
    $change_password_submit = mysqli_query($con, $change_password_query) or die(mysqli_errno($con));
    $row = mysqli_fetch_array($change_password_submit);
    
    if($row[0] == $old_password){
        if($new_password == $confirm_new_password){
            if(strlen($password) > 6){
                if($old_password != $new_password){
                    $query = "update users set password = '$new_password' where email = '$email'";
                    $submit = mysqli_query($con, $query) or die(mysqli_errno($con));
                    if(isset($_SESSION['id'])){
                        header('location: logout.php');
                        exit ;
                    }
                }
                else{
                    echo "<script>alert('New Password cannot be same as the old password.');"
                    . "window.location = 'change_password.php'; </script>";
                }
            }
            else{
                echo "<script>alert('New Password too short.');"
                . "window.location = 'change_password.php'; </script>";
            }
        }
        else{    
            echo "<script>alert('Passwords do not match.');"
            . "window.location = 'change_password.php'; </script>";
        }
    }
    else{        
        echo "<script>alert('Wrong password!!!');"
        . "window.location = 'change_password.php'; </script>";
    }
?>