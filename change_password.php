<?php
require 'includes/common.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="width: 40%; padding: 10px 10px; margin:auto;">
                    <div class="panel-heading" style="background-color: white;">
                        <center>Change Password</center>
                    </div>
                    <form action="change_password_script.php" method="POST">
                        <label for="old_password">Old Password</label>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Old Password" name="old_password"
                                required>
                        </div>
                        <label for="new_password">New Password</label>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password (Min. 6 characters)"
                                name="new_password" required>
                        </div>
                        <label for="re_new_password">Confirm New Password</label>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Re-type New Password"
                                name="re_new_password" required>
                        </div>
                        <button type="submit" name="submit" class="btn"
                            style="width: 100%; background-color: #00bca0; color:white;">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
       <?php 
       include 'includes/footer.php';
        ?>
</body>

</html>