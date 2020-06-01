<?php 
require 'includes/common.php';
$id = htmlspecialchars($_GET['id']);
$query = "SELECT * FROM new_expense WHERE id=$id";
$mysql = mysqli_query($con,$query);
if(mysqli_num_rows($mysql) > 0)
 {
  //The bill exists 
  $row = mysqli_fetch_assoc($mysql);
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Bill</title>
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
    ?> <br> <br> <br>
     <img src="<?php echo $row['bill']; ?>" alt="bill">
    <?php
    include 'includes/footer.php'; 
    ?>
</body>
</html>