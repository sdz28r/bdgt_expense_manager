<?php
    require 'includes/common.php';
?>

<?php

    $amount = 0;
    $email = $_SESSION['email'];
    $plan_id = $_POST['planDetailsId']; 
    
    if(isset($_POST['title'])){
        $plan_details_id = mysqli_real_escape_string($con, $_POST['planDetailsId']);

        $title = mysqli_real_escape_string($con, $_POST['title']);
        $person = mysqli_real_escape_string($con, $_POST['Person']);
        $amount_spent = mysqli_real_escape_string($con, $_POST['amountSpent']);
        $date_of_expense = mysqli_real_escape_string($con, $_POST['dateOfExpense']);
     
        function GetImageExtension($imagetype){
            if(empty($imagetype)) {
                return false;
            }
            switch($imagetype){
                case 'image/bmp': return '.bmp';
                case 'image/gif': return '.gif';
                case 'image/jpeg': return '.jpg';
                case 'image/png': return '.png';
                default: return false;                                                     
            } 
        }
        if (!empty($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $file_type = $_FILES['file']['type'];
            $temp_name = $_FILES['file']['tmp_name'];
            $ext = GetImageExtension($file_type);
            $imagename = date("d-m-Y")."-".time().$ext; 
            $target_path = "upload/".$imagename;
            if(move_uploaded_file($temp_name, $target_path)){ 
                $signup_query = "insert into new_expense_details(plan_details_id, title, date, amount_spent, person, image_path) values('$plan_details_id', '$title', "
                    . "'$date_of_expense', '$amount_spent', '$person', '$target_path')";
                $signup_submit = mysqli_query($con, $signup_query) or die(mysqli_errno($con));  
            }
        } else{
            $signup_query = "insert into new_expense_details(plan_details_id, title, date, amount_spent, person) values('$plan_details_id', '$title', "
                    . "'$date_of_expense', '$amount_spent', '$person')";
            $signup_submit = mysqli_query($con, $signup_query) or die(mysqli_errno($con));
        }
    }     
    
    $sum_query = "select sum(amount_spent) from new_expense_details where plan_details_id = '$plan_id'";
    $sum_submit = mysqli_query($con, $sum_query) or die(mysqli_errno($con));
    $ans = mysqli_fetch_array($sum_submit);
    $amount += $ans[0];

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>View Plan Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>
        <?php
            include 'includes/header.php';
        ?>
        
        <main>
            <div class="container">
                <div class="spacing-new">
                    <div class="row">
                        <div class="row">    
                            <?php          
                                $new_query = "select * from plan_details where id = '$plan_id'";
                                $new_result = mysqli_query($con, $new_query) or die(mysqli_error($con));
                                $row_second = mysqli_fetch_array($new_result);  
                            ?> 
                            <div class="col-xs-12 col-sm-8">
                                <div class="panel panel-default" style="width:75%">
                                    <div class="panel-heading" style="background-color: #00796b; color: white"> 
                                        <h4 style="text-align: center;"><?php echo $row_second['title'] ?><span class="glyphicon glyphicon-user" style="float: right;"><?php echo $row_second['number_of_people']; ?></span></h4>
                                    </div>
                                    <div class="panel-body">
                                        <form action="view_plan.php" method="post">
                                            <div class="form-group form-inline">
                                                <strong>Budget</strong>
                                                <span style="float: right;">
                                                    <?php  echo "₹ ".$row_second['initial_budget'];  ?></span>
                                            </div>
                                            <div class="form-group form-inline">
                                                <strong>Remaining Amount</strong>
                                                <?php $amount = $row_second['initial_budget'] - $amount; ?>
                                                <span style="float: right; <?php if($amount>0) {?>
                                                      color: green;
                                                          <?php } else if($amount<0) { ?>
                                                              color: red;
                                                          <?php }?>"><?php if($amount<0){
                                                              echo "Overspent by ₹ ".abs($amount);
                                                          } else{
                                                              echo "₹ ".$amount;
                                                          } ?></span>
                                            </div>
                                            <div class="form-group form-inline">
                                                <strong>Date</strong>
                                                <span style="float: right;">
                                                    <?php         
                                                        $from_date_query = "select date_format(from_date, '%D %b') from plan_details where id = '$plan_id'";
                                                        $from_date_query_result = mysqli_query($con, $from_date_query);
                                                        $row_third = mysqli_fetch_array($from_date_query_result);
                                                        $to_date_query = "select date_format(to_date, '%D %b %Y') from plan_details where id = '$plan_id'";
                                                        $to_date_query_result = mysqli_query($con, $to_date_query);
                                                        $row_forth = mysqli_fetch_array($to_date_query_result);
                                                        echo $row_third[0]." - ".$row_forth[0]; ?>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:0px ; margin-right: 0px;">
                                    <?php 
                                        $query_sixth = "select * from new_expense_details where plan_details_id = '$plan_id'";
                                        $row_sixth = mysqli_query($con, $query_sixth);
                                        $num_rows = mysqli_num_rows($row_sixth);
                                        if($num_rows > 0){
                                        for($i=0;$i<$num_rows;$i++){
                                            $arr_rows = mysqli_fetch_array($row_sixth);

                                            $date_query = "select date_format(date, '%D %b %Y'), image_path from new_expense_details where id = '$arr_rows[0]'";
                                            $date_submit = mysqli_query($con, $date_query);
                                            $row_seventh = mysqli_fetch_array($date_submit);?>
                                            <div class="col-sm-6 col-xs-12 col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" style="background-color: #00796b; color: white"> 
                                                        <h4 style="text-align: center;"><?php echo $arr_rows['title'] /*substr($arr_rows['title'], 0, 20);*/ ?></h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <form action="" method="">
                                                            <div class="form-group form-inline">
                                                                <strong>Amount</strong>
                                                                <span style="float: right;">
                                                                    <?php echo "₹ ".$arr_rows['amount_spent']; ?></span>
                                                            </div>
                                                            <div class="form-group form-inline">
                                                                <strong>Paid By</strong>
                                                                <span style="float: right;">
                                                                    <?php echo $arr_rows['person']; ?></span>
                                                            </div>
                                                            <div class="form-group form-inline">
                                                                <strong>Paid on</strong>
                                                                <span style="float: right;">
                                                                    <?php echo $row_seventh[0]; ?></span>
                                                            </div>
                                                            <div class="form-group form-inline">
                                                                <center>
                                                                <span style="float: bottom; color: DodgerBlue;">
                                                                    <?php if($row_seventh[1] == ""){
                                                                        echo "You Don't have bill";}
                                                                    else{
                                                                        echo "<a href = \"$row_seventh[1]\" target = _blank style = \"text-decoration: none;\">Show bill</a>";
                                                                    } ?></span>
                                                                </center>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <form action="expense_distribution.php" method="post">
                                    <input type="hidden" name="planDetailsId" value="<?php echo $plan_id; ?>">
                                    <input type="hidden" name="remainingAmount" value="<?php echo $amount; ?>">
                                    <button type="Submit" class=" btn btn-primary btn-lg button" id="hoverOver" style="margin-top: 16%; margin-bottom: 26%;">Expense Distribution</button>
                                </form> 
                                <div class="row">            
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="background-color: #00796b; color: white;"> 
                                                <center>
                                                    <h5>Add New Expense</h5>
                                                </center>
                                            </div>
                                            <div class="panel-body">
                                                <form action="view_plan.php" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <strong>Title</strong><br>
                                                        <input type="text" required class="form-control" placeholder="Expense Name" name="title" >
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Date</strong><br>
                                                        <input type="date" required class="form-control" placeholder="" name="dateOfExpense" min="<?php 
                                                            $from_to_date_query = "select from_date, to_date from plan_details where id = '$plan_id'";
                                                            $from_to_date_query_result = mysqli_query($con, $from_to_date_query);
                                                            $row_eighth = mysqli_fetch_array($from_to_date_query_result);
                                                            echo $row_eighth[0]; ?>" max="<?php echo $row_eighth[1]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Amount Spent</strong><br>
                                                        <input type="text" required class="form-control" placeholder="Amount Spent" name="amountSpent">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="Person" required class="form-control">
                                                            <option value="null" selected>Choose</option>
                                                            <?php 
                                                                $member_details_query = "select * from plan_members where plan_details_id = '$plan_id'";
                                                                $member_details_query_result = mysqli_query($con, $member_details_query) or die(mysqli_error($con));
                                                                $row_fifth = mysqli_fetch_array($member_details_query_result);
                                                                $num_people = $row_second['number_of_people']+4;
                                                                for($i=4;$i<$num_people;$i++){

                                                            ?>
                                                            <option value="<?php echo $row_fifth[$i]; ?>"> <?php echo $row_fifth[$i]; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Upload Bill</strong><br>
                                                        <input type="file" class="form-control" name="file">
                                                    </div>
                                                    <input type="hidden" name="planDetailsId" value="<?php echo $plan_id; ?>">

                                                    <div class="form-group">
                                                        <strong><button type="Submit" class="btn btn-primary button form-control">Add</button></strong>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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