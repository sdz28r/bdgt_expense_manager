<?php
    require 'includes/common.php';
    
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $from_date = mysqli_real_escape_string($con, $_POST['fromDate']);
    $to_date = mysqli_real_escape_string($con, $_POST['toDate']);
    $initial_budget = mysqli_real_escape_string($con, $_SESSION['initial_budget']);
    $number_of_people = mysqli_real_escape_string($con, $_SESSION['number_of_people']);
    $email = mysqli_real_escape_string($con, $_SESSION['email']);
    
    $id = mysqli_query($con, "select id from plan where user_email = '$email' and initial_budget = '$initial_budget' and number_of_people = '$number_of_people'");
    $row = mysqli_fetch_array($id);
            
    $insert_plan_details_query = "insert into plan_details(plan_id, title, from_date, to_date, initial_budget, number_of_people) values('$row[0]', '$title', '$from_date', '$to_date', '$initial_budget', '$number_of_people')";
    $insert_plan_details_submit = mysqli_query($con, $insert_plan_details_query) or die(mysqli_error($con));
    
    $extract_plan_details_query = "select id from plan_details where plan_id = '$row[0]' and title = '$title'";
    $extraxt_plan_details_submit = mysqli_query($con, $extract_plan_details_query) or die(mysqli_error($con));
    $row_second = mysqli_fetch_array($extraxt_plan_details_submit);
    
    $_SESSION['title'] = $title;
    $_SESSION['from_date'] = $from_date;
    $_SESSION['to_date'] = $to_date;
    
    $insert_plan_members_ids_query = "insert into plan_members(user_email, plan_id, plan_details_id) values('$email', '$row[0]', '$row_second[0]')";
    $insert_plan_members_ids_submit = mysqli_query($con, $insert_plan_members_ids_query) or die(mysqli_error($con));
    for($i=1; $i<=$number_of_people; $i++){
        $person = "Person$i";
        $person_name = $_POST[$person];
        $insert_plan_members_query = "update plan_members set $person = '$person_name' where user_email = '$email' and plan_id = '$row[0]' and plan_details_id = '$row_second[0]'";
        $insert_plan_members_submit = mysqli_query($con, $insert_plan_members_query) or die(mysqli_error($con));
    }
    echo 'Done';
    
    if(isset($_SESSION['id'])){
        header('location: home.php');
        exit ;
    }
?>