<?php
require 'includes/common.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Details</title>
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
    <div class="container" style="margin-top: 100px;">
        <div class="panel panel-default" style="width: 40%; padding: 10px 10px; margin:auto;">
            <form action="details_script.php" method="POST">
                <label for="title">Title</label>
                <div class="form-group">
                    <input class="form-control" placeholder="Enter Title (Ex. Trip to Goa)" name="title" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="from">From</label>
                        <div class="form-group">
                            <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="from" required  min="2020-05-03" max="2021-06-03">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="to">To</label>
                        <div class="form-group">
                            <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="to" required  min="2020-06-30" max="2050-06-30">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="initial_budget">Initial Budget</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php
$email = $_SESSION['email'];
$user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
$stmt = mysqli_fetch_assoc($user);
$id = $stmt['id'];
$plan_id=$_SESSION['plan_id'];
$sql =mysqli_query($con, "SELECT initial_budget FROM plan_details WHERE user_id = $id AND id= $plan_id");
$result = mysqli_fetch_assoc($sql);
$budget = $result['initial_budget'];
 echo htmlspecialchars($budget); 
?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="no_of_people">No of people</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" name="no_of_people" readonly value=" <?php $email = $_SESSION['email'];
$user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
$stmt = mysqli_fetch_assoc($user);
$id = $stmt['id'];
$sql1 =mysqli_query($con, "SELECT no_of_people FROM plan_details WHERE user_id = $id AND id=$plan_id" );
$result = mysqli_fetch_assoc($sql1);
$people = $result['no_of_people'];
 echo htmlspecialchars($people);?>">
                        </div>

                    </div>

                    <?php 
                    $sql3 = mysqli_query($con, "SELECT no_of_people FROM plan_details WHERE user_id= $id AND id=$plan_id");
                    $req = mysqli_fetch_assoc($sql3);
                    $number = $req['no_of_people'];
                    for ($i=1; $i<= $number; $i++)
            
                    { ?>
                      <div class="col-md-12">
                        <label>Person <?php echo $i; ?></label>
                        <div class="form-group">
                    
                            <input type="text" class="form-control" placeholder="Person <?php echo $i; ?> Name"  name="<?php echo $i?>" required>
                        </div>
                    </div>
                
                   <?php
                
                    }
                    ?>
                </div>

                <button type="submit" name="submit" class="btn fx"
                    style="width: 100%; border: 1px solid #00bca0;  cursor: pointer;">Submit</button>
            </form>
        </div>
    </div>
    <?php
    include 'includes/footer.php'; 
    ?>
</body>

</html>