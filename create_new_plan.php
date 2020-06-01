<?php
require 'includes/common.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Plan</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
    include 'includes/header.php';
    ?>

<div class="container" style="margin-top: 100px">
    <div class="panel panel-default" style="width: 40%; padding: 10px 10px; margin:auto;">
        <div class="panel-heading" style="background-color: white;">
            <center>Create New Plan</center>
        </div>
        <label for="e-mail">Initial Budget</label>
        <form action="create_new_plan_script.php" method="POST">
            <div class="form-group">
                <input type="initial_budget" class="form-control" placeholder="Initial Budget (Ex 4000)" name="budget" required>
            </div>
            <label for="people">How many people you want to add in your group?</label>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="No. of people" name="people" required>
            </div>
            <button type="submit" name="submit" class="btn fx" style =" width: 100%; border: 1px solid #00bca0">Next</button>
        </form>
    </div>
</div>


    <?php 
    include 'includes/footer.php'; 
    ?>
</body>
</html>