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
        <title>Create New Plan Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script> 
            function InvalidMsg(textbox) { 
                if (textbox.value === '' && textbox.name === "initialBudget") { 
                    textbox.setCustomValidity ('Please enter the initial budget'); 
                } else if (textbox.value < 50 && textbox.name === "initialBudget") { 
                    textbox.setCustomValidity ('Value must be greater than or equal to 50.'); 
                } else if (textbox.value === '' && textbox.name === "numberOfPeople"){ 
                    textbox.setCustomValidity('Please enter the number of people involved in the plan'); 
                } else if(textbox.value < 1 && textbox.name === "numberOfPeople"){
                    textbox.setCustomValidity('Value must be greater than or equal to 1.');
                } else{
                    textbox.setCustomValidity('');
                }
                return true; 
            } 
        </script> 
    </head>
    
    <body>
        <?php
            include 'includes/header.php';
        ?>
        
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-md-6 col-md-offset-3 col-xs-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="background-color: #00796b;"> 
                                <center>
                                    <h3>Create New Plan</h3>
                                </center>
                            </div>
                            <div class="panel-body">
                                <form action="create_new_plan_script.php" method="post">
                                    <div class="form-group">
                                        <strong>Initial Budget</strong><br>
                                        <input type="tel" min="50" required class="form-control" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" placeholder="Initial Budget(Ex. 4000)" name="initialBudget">
                                    </div>
                                    <div class="form-group">
                                        <strong>How many people you want to add in your group?</strong><br> 
                                        <input type="tel" min="1" required class="form-control" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" placeholder="No. of people" name="numberOfPeople">
                                    </div>
                                    <div class="form-group">
                                        <strong><button type="Submit" class="btn btn-primary buttonindex form-control">Next</button></strong>
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