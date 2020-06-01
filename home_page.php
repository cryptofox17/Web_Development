<?php
require 'includes/common.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
    <?php 
require 'includes/common.php';
$email = $_SESSION['email'];
$user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
$result = mysqli_fetch_assoc($user);
$id = $result['id'];
$query = "SELECT * FROM plan_details WHERE user_id = $id";
$stmt = mysqli_query($con,$query);
$rows = mysqli_num_rows($stmt);
if($rows > 0)
 {  // there are results ?>
    <div class="container" style="margin-top: 100px">
        <h4>Your Plans</h4>
    </div>
    <?php
 // write query for all plans
 $sql = "SELECT * FROM plan_details WHERE user_id = $id";
 // get the resulting row set
 $res = mysqli_query($con,$sql);
 // fetch the resulting rows as an array
 $plans =  mysqli_fetch_all($res, MYSQLI_ASSOC);
 ?> <div class="container">
        <div class="row">
            <?php
 foreach ($plans as $plan) 
 {
     ?>
            <div class="col-md-3 col-sm-6">
               
            <div class="panel panel-default">
   <div class="panel-heading" style="background-color: #00bca0; color:white; text-align:center;">
   <?php echo htmlspecialchars($plan['title']);?><span class="glyphicon glyphicon-user" style="float: right;"> <?php echo htmlspecialchars($plan['no_of_people']);?></span> 
                    </div>
                    <table style="width:100%; margin:20px; line-height:250%;">

<tr>
    <td>Budget</td>
    <td style="padding: 3px">    &#8377 <?php echo htmlspecialchars($plan['initial_budget']); ?> </td>


</tr>

<tr>
    <td>Date</td>
    <td><?php  $date_from= htmlspecialchars($plan['from_date']);
               $date_to =htmlspecialchars($plan['to_date']);
    echo date("jS M - ", strtotime("$date_from")).date("jS M Y", strtotime("$date_to")); ?></td>

</tr>
</table>
<a href="viewplan.php?id=<?php echo htmlspecialchars($plan['id']);?>"> <button class="btn" style =" width: 100%; border: 1px solid #00bca0" > View Plan </button></a>     
   </div>


            </div>
        
    <?php
 } ?>
</div>
    </div> 
    <div class="container-fluid" style="position: fixed; bottom:50px; right:0;"><a href="create_new_plan.php"><span class="glyphicon glyphicon-plus-sign" style="font-size: 50px; color:#00bca0;" ></span></a>
</div>
    <?php
 }

else {  
    
    // there are no results, so the user doesn't have any plans
    ?>
    <div class="container" style="margin-top: 100px;">
        <p>You don't have any plans.</p>
        <div class="panel panel-default" style="margin: auto; height: 250px; width: 250px;">
            <div style="width: 100%; margin-left:50px ; margin-top: 120px;">
                <span class="glyphicon glyphicon-plus-sign" style="color: #00bca0"></span>
                <a href="create_new_plan.php">Create a New Plan</a>
            </div>
        </div>
    </div>

    <?php 
 }
  ?>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>