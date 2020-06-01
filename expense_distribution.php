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
$persons = mysqli_fetch_all($rows, MYSQLI_ASSOC);


$sql1 = "SELECT title, spent, id, by_person,date FROM new_expense WHERE plan_id = $id"; 
$res = mysqli_query($con,$sql1);
$expenses =  mysqli_fetch_all($res, MYSQLI_ASSOC);


$query=mysqli_query($con,"SELECT SUM(spent) AS total FROM new_expense WHERE plan_id=$id");
$row = mysqli_fetch_assoc($query);
$sum = $row['total'];
$remaining= htmlspecialchars($plan['initial_budget'])-htmlspecialchars($sum);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Distribution</title>
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
        <div class="panel panel-default" style="margin:auto; width: 50%;">
         <div class="panel-heading" style="background-color: #00bca0; color:white; text-align:center;">
         <?php echo htmlspecialchars($plan['title']); ?>  <span class="glyphicon glyphicon-user" style="float: right;"> <?php echo htmlspecialchars($plan['no_of_people']); ?> </span>
         </div>
         <br>
         <table style="width:100%; margin:20px; line-height:250%;">

<tr>
    <td>Initial Budget</td>
    <td> &#8377 <?php echo htmlspecialchars($plan['initial_budget']); ?> </td>


</tr>

<?php
foreach ($persons as $person)
     { 
        $name= htmlspecialchars($person['name']); 
        $necessary= mysqli_query($con, "SELECT SUM(spent) AS tot FROM new_expense WHERE by_person= '$name' AND plan_id=$id");
        $rw = mysqli_fetch_assoc($necessary);
        $req = $rw['tot'];
    ?>
    <tr>  
        <td> <?php echo htmlspecialchars($person['name']); ?></td>
        <td>  &#8377 <?php echo htmlspecialchars($req); ?></td>
    </tr>
<?php } 
?>

<tr>
    <td>Total Amount Spent</td>
    <td> &#8377 <?php if($sum != NULL) echo htmlspecialchars($sum);
    else echo 0; ?> </td>


    </tr>
    <td>Remaining Amount</>
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
    <td>Individual Shares</td>
    <td>&#8377 <?php echo round($sum/ htmlspecialchars($plan['no_of_people'])); ?></td>

</tr>


<?php foreach ($persons as $person)
{    $name= htmlspecialchars($person['name']); 
    $necessary= mysqli_query($con, "SELECT SUM(spent) AS tot FROM new_expense WHERE by_person= '$name' AND plan_id=$id");
    $rw = mysqli_fetch_assoc($necessary);
    $req = $rw['tot'];
    $display= htmlspecialchars($req)- round($sum/ htmlspecialchars($plan['no_of_people']));
    ?>
    <tr>
        <td> <?php echo htmlspecialchars($person['name']); ?></td>
        <td> <?php 
        if ($display >0) { ?>
        <p style="color:#19FF19; display:inline;">  <?php
        echo 'Get back ₹'.$display; ?></p>
       <?php 
        }
        elseif ($display <0) { 
            ?>
     <p style="color: red; display:inline;"><?php echo 'Owes ₹'.abs($display); ?></p>  
     <?php   }
        else echo 'All Settled up.'?>  
        
             </td>
    </tr>
<?php } ?>

</table> 
         <center><a href="viewplan.php?id=<?php echo htmlspecialchars($id);?>" class="btn" style="background-color: white; color:#00bca0; border: 1px solid #00bca0;">  <span class="glyphicon glyphicon-arrow-left"></span> Go Back </a></center>
<br>
        </div>
    </div>
    <?php
    include 'includes/footer.php'; 
    ?>
</body>
</html>