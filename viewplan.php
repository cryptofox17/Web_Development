<?php
require 'includes/common.php'; 
if (isset($_GET['id']))
{
$id = mysqli_real_escape_string($con, $_GET['id']);
$sql = "SELECT * FROM plan_details WHERE id=$id";
$result = mysqli_query($con, $sql);
$plan = mysqli_fetch_assoc($result);

$stmt= "SELECT * FROM names WHERE plan_id=$id ";
$rows = mysqli_query($con,$stmt); 
$sql1 = "SELECT title, spent, id, by_person,date, bill FROM new_expense WHERE plan_id = $id"; 
$res = mysqli_query($con,$sql1);
$expenses =  mysqli_fetch_all($res, MYSQLI_ASSOC);

$query=mysqli_query($con,"SELECT SUM(spent) AS total FROM new_expense WHERE plan_id=$id");
$row = mysqli_fetch_assoc($query);
$sum = $row['total'];

//TO GET THE REMAINING AMOUNT/ BALANCE
$remaining= htmlspecialchars($plan['initial_budget'])-htmlspecialchars($sum);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Plan</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <?php include 'includes/header.php';
     ?>

    <div class="container" style="margin-top:100px;">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #00bca0; color:white; text-align:center;">
                        <?php echo $plan['title']; ?> <span class="glyphicon glyphicon-user" style="float: right;">
                            <?php echo htmlspecialchars($plan['no_of_people']); ?> </span>

                    </div>
                    <table style="width:100%; margin:30px; line-height:250%;">

                        <tr>
                            <td>Budget</td>
                            <td> &#8377 <?php echo htmlspecialchars($plan['initial_budget']); ?> </td>
                        </tr>

                        <tr>
                            <td>Remaining Amount</td>
                            <td> <?php if($remaining>0)
                            {
                             ?>
                                <p style="color:#19FF19; display:inline"> &#8377 <?php echo $remaining; ?></p>
                                <?php
                            }
                      
                            else if ($remaining<0)
                            {
                             ?>
                                <p style="color: red; display:inline;">&#8377 <?php echo $remaining; ?></p>
                                <?php } 
                            else 
                            { ?>
                                <p style="color: black; display:inline;">&#8377 <?php echo $remaining; ?></p>
                                <?php    } ?>
                            </td>

                        </tr>
                        <tr>
                            <td>Date</td>
                            <td> <?php  $date_from= htmlspecialchars($plan['from_date']);
               $date_to =htmlspecialchars($plan['to_date']);
    echo date("jS M Y -", strtotime("$date_from")).date(" jS M Y", strtotime("$date_to")); ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4" style="text-align: right; height:200px;">
                <a class="btn" href="expense_distribution.php?id=<?php echo htmlspecialchars($id);?>"
                    style="color:#00bca0; border:#00bca0 1px solid; background-color:white; padding: 10px; top:50%; position:relative;">
                    Expense Distribution </a></Expense>

            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
        <div class="col-md-6 col-sm-12">
            <?php
    foreach ($expenses as $expense)
    {
    ?>
               <div class="col-md-6 col-sm-12"> 
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #00bca0; color:white;">
                        <center><?php echo $expense['title']; ?></center>
                    </div>
                    <table style="width:100%; margin:20px; line-height:250%;">
                        <tr>
                            <td>Amount</td>
                            <td> &#8377 <?php echo htmlspecialchars($expense['spent']);?></td>

                        </tr>
                        <tr>
                            <td>Paid by</td>
                            <td><?php echo htmlspecialchars($expense['by_person']);?></td>

                        </tr>
                        <tr>
                            <td>Paid on</td>
                            <td> <?php echo htmlspecialchars($expense['date']);?> </td>
                        </tr>
                    </table>
                    <div class="bill"> 
                        <?php if(!isset($expense['bill'])){
                            ?> <p style="text-align:center; color:#40bad5;">   <?php  echo "You don't have bill"; ?></p>
                     
                        <?php } else {?><p style="text-align:center; color:#40bad5;">  <a href="showbill.php?id=<?php echo htmlspecialchars($expense['id']); ?>" style="color: #40bad5;"><?php  echo "Show Bill"; ?></a> </p> <?php } ?>
                    </div>
                </div>
                </div>
           
            <?php 
    }
    ?>     </div>
            <div class="col-md-6">

                <div class="panel panel-default" style="width: 90%; float:right;">
                    <div class="panel-heading" style="background-color: #00bca0; color:white;">
                        <center>Add New Expense</center>
                    </div>
                    <form action="new_expense_script.php" method="POST" style="padding: 10px 10px;" enctype='multipart/form-data'>
                        <?php  foreach ($rows as $row)
           {  ?>
                        <input type="hidden" value="<?php echo $row['plan_id']; ?>" name="id">
                        <?php
          } ?>

                        <label for="title">Title</label>
                        <div class="form-group">
                            <input class="form-control" placeholder="Expense Name" name="title" required>
                        </div>
                        <label for="date">Date</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="date" required>
                        </div>
                        <label for="amount_spent">Amount Spent</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Amount Spent" name="spent" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="choice" required>
                                <option value="" disabled selected hidden>Choose</option>
                                <?php
                        foreach ($rows as $row)
                        {  
                            ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>

                                <?php } 
                        ?>
                            </select>
                        </div>
                        <label for="file">Upload Bill</label>
                        <div class="form-group">
                            <input type="file" class="form-control" placeholder="No file chosen" name="bill">
                        </div>
                        <button type="submit" name="submit" class="btn fx"
                            style="width: 100%; border: 1px solid #00bca0;  cursor: pointer;">Add</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <br> <br>
    <?php include 'includes/footer.php';
    ?>
</body>

</html>