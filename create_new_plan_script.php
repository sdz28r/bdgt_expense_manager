<?php
    require 'includes/common.php';
    
    $initial_budget = mysqli_real_escape_string($con, $_POST['initialBudget']);
    $number_of_people = mysqli_real_escape_string($con, $_POST['numberOfPeople']);
    
    $email = $_SESSION['email'];
    
    $insert_plan_query = "insert into plan(user_email, initial_budget, number_of_people) values('$email', '$initial_budget', '$number_of_people')";
    $insert_plan_submit = mysqli_query($con, $insert_plan_query) or die(mysqli_error($con));
    
    $_SESSION['initial_budget'] = $initial_budget;
    $_SESSION['number_of_people'] = $number_of_people;
    
    if(isset($_SESSION['id'])){
        header('location: plan_details.php');
        exit ;
    } 
?>