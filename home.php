<?php
    require 'includes/common.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            include 'includes/header.php';
        ?>
        
        <main style="margin-bottom: 200px">
            <?php
                $email = $_SESSION['email'];
                $query = "select * from plan_members where user_email = '$email'";
                $result = mysqli_query($con, $query);
                $rows_selected = mysqli_num_rows($result);
                if($rows_selected < 1) { ?>        
                    <div class='container'>
                            <h3>You don't have any active plans</h3>
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1 col-md-offset-4 col-md-4">
                                <div class="box">
                                    <p><a href="create_new_plan.php" style="text-decoration: none;"><span class="glyphicon glyphicon-plus-sign" style="color: #00796b;"></span>Create a New Plan</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } else{ ?>
                        <div class='container'>
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <h2>Your Plans</h2>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">    
                                <?php for($i=0;$i<$rows_selected;$i++){
                                    $row_first = mysqli_fetch_array($result);
                                    $new_query = "select * from plan_details where id = '$row_first[3]'";
                                    $new_result = mysqli_query($con, $new_query) or die(mysqli_error($con));
                                    $row_second = mysqli_fetch_array($new_result); ?> 
                                    <div class="col-md-3 col-sm-8 col-xs-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="background-color: #00796b; color: white"> 
                                                <h4 style="text-align: center;"><?php echo $row_second['title']; ?><span class="glyphicon glyphicon-user" style="float: right;"><span style=" vertical-align: top;"><?php echo "".$row_second['number_of_people']; ?></span></span></h4>
                                            </div>
                                            <div class="panel-body">
                                                <form action="view_plan.php" method="post">
                                                    <div class="form-group form-inline">
                                                        <strong>Budget</strong>
                                                        <span style="float: right;"><?php echo "₹ ".$row_second['initial_budget']; ?></span>
                                                        <input type="hidden" name="planDetailsId" value="<?php echo $row_first[3]; ?>">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <strong>Date</strong>
                                                        <span style="float: right;"><?php 
                                                        
                                                            $from_date_query = "select date_format(from_date, '%D %b') from plan_details where id = '$row_first[3]'";
                                                            $from_date_query_result = mysqli_query($con, $from_date_query);
                                                            $row_third = mysqli_fetch_array($from_date_query_result);
                                                            
                                                            $to_date_query = "select date_format(to_date, '%D %b %Y') from plan_details where id = '$row_first[3]'";
                                                            $to_date_query_result = mysqli_query($con, $to_date_query);
                                                            $row_forth = mysqli_fetch_array($to_date_query_result);
                                                       
                                                        echo $row_third[0]." - ".$row_forth[0]; ?></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong><button type="Submit" class="btn btn-primary form-control button">View Plan</button></strong>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                </main>
            <div class="abovefooter">
                <a href="create_new_plan.php"  id="plan" class="glyphicon glyphicon-plus-sign lg"></a>   
            </div>
        <?php } ?>
         
        <footer>
            <div class="footer">
                <center>
                    <p>Copyright © Control Budget. All Rights Reserved|Contact Us: +91-8190847372</p>
                </center>
            </div>
        </footer>
    </body>
</html>