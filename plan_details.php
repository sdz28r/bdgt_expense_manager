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
        <title>Plan Details Page</title>
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
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <form action="plan_details_script.php" method="post">
                            <div id="box">
                                <div class="form-group">
                                    <strong>Title</strong>
                                    <input type="text" class="form-control" required placeholder="Enter Title (Ex. Trip to Goa)" name="title">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>From</strong>
                                            <input type="date" id="datefield" required class="form-control" placeholder="dd/mm/yyyy" name="fromDate">                        
                                        </div>
                                        <div class="col-xs-6">
                                            <strong>To</strong>
                                            <input type="date" id="datefield" required class="form-control" placeholder="dd/mm/yyyy" name="toDate" min= fromDate.value>                        
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <strong>Initial Budget</strong>
                                            <input type="text" class="form-control" required placeholder="" value="<?php echo($_SESSION['initial_budget']); ?>" name="initialBudget" disabled>                        
                                        </div>
                                        <div class="col-xs-4">
                                            <strong>To</strong>
                                            <input type="text" class="form-control" required placeholder="" value="<?php echo($_SESSION['number_of_people']); ?>" name="numberOfPeople" disabled>                        
                                        </div>
                                    </div>
                                </div>
                                
                                <?php                                     
                                    for($i=0; $i<$_SESSION['number_of_people']; $i++){ ?>
                                        <div class="form-group">
                                            <strong>Person <?php echo($i+1); ?></strong>
                                            <input type="text" class="form-control" required placeholder="Person <?php echo($i+1); ?> Name" name="Person<?php echo($i+1); ?>">                        
                                        </div>
                                <?php } ?> 
                                <div class="form-group">
                                    <strong><button type="Submit" class="btn btn-primary buttonindex form-control">Submit</button></strong>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>