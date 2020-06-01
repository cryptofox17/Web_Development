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

<body style="padding-top: 50px;">
    <?php
include 'includes/header.php'; 
?>
<br> <br>
    <div class="container">
        <div class="panel panel-default"  style="width: 40%; padding: 10px 10px; margin:auto;">
            <div class="panel-heading" style="background-color: white;">
                <center>Sign Up</center>
            </div>  
                    <form action="signup_script.php" method="POST">
                        <label for="name">Name:</label>
                        <div class="form-group">
                            <input class="form-control" placeholder="Name" name="name" required>
                        </div>
                        <label for="e-mail">Email:</label>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter Valid Email" name="e-mail"
                                required>
                        </div>
                        <label for="password">Password:</label>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password (Min. 6 characters)"
                                name="password" required>
                        </div>
                        <label for="phone">Phone Number:</label>
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Enter Valid Phone Number (Ex. 8448444853)" name="phone" required>
                        </div>
                        <button type="submit" name="submit" class="btn"  style = "width: 100%; background-color: #00bca0; color:white;">Submit</button>
                    </form>          
        </div>
    </div>
    <?php 
include 'includes/footer.php';
?>
</body>

</html>