<?php 
require 'includes/common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<br> <br> <br> <br>
<div class="container">
    <div class="panel panel-default" style="width: 40%; padding: 10px; margin:auto;">
        <div class="panel-heading" style="background-color: white;">
            <center>Login</center>
        </div>
        <form action="login_script.php" method="POST">
        <label for="e-mail">Email:</label>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="e-mail" required>
            </div>
            <label for="password">Password:</label>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn" style="width: 100%; background-color:#00bca0; color:white;">Login</button>
        </form>
        
    </div>
    <div class="panel-footer"  style="width: 40%; padding: 10px; margin:auto;" >Don't have an account? <a href="signup.php">Click here to Sign Up</a></div>
</div>


     <?php
    include 'includes/footer.php'; 
    ?>
</body>
</html>