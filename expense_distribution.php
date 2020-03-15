<?php

    require 'includes/common.php';
    
    $plan_details_id = $_POST['planDetailsId'];
    $remaining_amount = $_POST['remainingAmount'];
    
    $plan_details_query = "select * from plan_details where id = '$plan_details_id'";
    $plan_details_submit = mysqli_query($con, $plan_details_query) or die(mysqli_error($con));
    $plan_details_array = mysqli_fetch_array($plan_details_submit);
    
    $plan_members_query = "select * from plan_members where plan_details_id = '$plan_details_id'";
    $plan_members_submit = mysqli_query($con, $plan_members_query) or die(mysqli_error($con));
    $plan_members_array = mysqli_fetch_array($plan_members_submit);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Expense Distribution Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            include 'includes/header.php';
        ?>
        
        <main>
            <div class="container">     
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: #00796b; color: white"> 
                                <h5 style="text-align: center;"><?php echo $plan_details_array['title'];?><span class="glyphicon glyphicon-user" style="float: right;"><?php echo $plan_details_array['number_of_people'];?></span></h5>
                            </div>
                            <div class="panel-body" style="padding-bottom: -50px;">
                                <form action="view_plan.php" method="post">
                                    
                                    <div class="form-group form-inline">
                                        <strong>Initial Budget</strong>
                                        <span style="float: right;">
                                            <?php echo "₹ ".$plan_details_array['initial_budget']; ?></span>
                                    </div>
                                    
                                    <?php $num_people = $plan_details_array['number_of_people']+4; 
                                        for($i=4;$i<$num_people;$i++){ ?>
                                        <div class="form-group form-inline">
                                            <strong><?php echo $plan_members_array[$i]; ?></strong>
                                            <span style="float: right;">
                                                <?php 
                                                $query = "select sum(amount_spent) from new_expense_details where plan_details_id = '$plan_details_id' && person = '$plan_members_array[$i]'";
                                                $submit = mysqli_query($con, $query) or die(mysqli_error($con));
                                                $row = mysqli_fetch_array($submit);
                                                $k = 0;
                                                $k += $row[0];
                                                if($k-(int)$k == 0){
                                                    echo "₹ ".(int)$k;
                                                } else{
                                                    echo "₹ ".number_format((float)$k, 2, '.', '');
                                                }?></span>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group form-inline">
                                        <strong>Total amount spent</strong>
                                        <span style="float: right;">
                                            <?php $amount_spent = $plan_details_array['initial_budget'] - $remaining_amount; echo "₹ ".$amount_spent; ?></span>
                                    </div>
                                    
                                    <div class="form-group form-inline">
                                        <strong>Remaining Amount</strong>
                                        <span style="float: right; <?php if($remaining_amount>0) {?>
                                            color: green;
                                            <?php } else if($remaining_amount<0) { ?>
                                                color: red;
                                            <?php }?>"><?php if($remaining_amount<0){
                                                if($individual_spent-(int)$individual_spent == 0){
                                                    echo "Overspent by ₹ ".abs($remaining_amount);
                                                } else{
                                                    echo "Overspent by ₹ ".number_format((float)$remaining_amount, 2, '.', '');
                                                }
                                            } else{
                                                echo "₹ ".(int)$remaining_amount;
                                        } ?></span>
                                    </div>
                                    
                                    <div class="form-group form-inline">
                                        <strong>Individual shares</strong>
                                        <span style="float: right;">
                                            <?php $individual_spent = $amount_spent/$plan_details_array['number_of_people']; 
                                            if($individual_spent-(int)$individual_spent == 0){
                                                echo "₹ ".(int)$individual_spent;
                                            } else{
                                                echo "₹ ".number_format((float)$individual_spent, 2, '.', '');
                                            } ?></span>
                                    </div>
                                    
                                    <?php for($i=4;$i<$num_people;$i++){ 
                                        $query = "select sum(amount_spent) from new_expense_details where plan_details_id = '$plan_details_id' && person = '$plan_members_array[$i]'";
                                        $submit = mysqli_query($con, $query) or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($submit);
                                        $give_or_take = $row[0] - $amount_spent/$plan_details_array['number_of_people']; ?>
                                        <div class="form-group form-inline">
                                            <strong><?php echo $plan_members_array[$i]; ?></strong>
                                            <span style="float: right; <?php if($give_or_take>0) {?>
                                            color: green;
                                            <?php } else if($give_or_take<0) { ?>
                                                color: red;
                                            <?php }?>"><?php if($give_or_take<0){
                                                if($give_or_take-(int)$give_or_take == 0){
                                                    echo "Owes ₹ ".(int)abs($give_or_take);
                                                } else{
                                                    echo "Owes ₹ ".number_format(abs((float)$give_or_take), 2, '.', '');
                                                }
                                            } else if($give_or_take>0){
                                                if($give_or_take-(int)$give_or_take == 0){
                                                    echo "Gets Back ₹ ".(int)$give_or_take;
                                                } else{
                                                    echo "Gets Back ₹ ".number_format((float)$give_or_take, 2, '.', '');
                                                }
                                        } else{
                                            echo "₹ 0";
                                        } ?></span>
                                        </div>
                                    <?php } ?>
                                    
                                    <input type="hidden" name="planDetailsId" value="<?php echo $plan_details_id; ?>">
                                    <div class="form-group">
                                        <center>
                                            <strong><button type="Submit" class="btn btn-primary button"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</button></strong>
                                        </center>
                                    </div>                                 
                                </form>
                            </div>        
                        </div>     
                    </div>
                </div>  
            </div>
        </main>
        
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>