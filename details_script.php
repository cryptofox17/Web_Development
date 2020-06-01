<?php
require 'includes/common.php';
$title= $_POST['title'];
$from = mysqli_real_escape_string($con, $_POST['from']);
$to = mysqli_real_escape_string($con, $_POST['to']);
$email=$_SESSION['email'];
$user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
$result = mysqli_fetch_assoc($user);
$id = $result['id'];
$plan_id= $_SESSION['plan_id'];
$details_insertion_query = "UPDATE plan_details SET title='$title', from_date='$from', to_date='$to' WHERE user_id = $id AND id = $plan_id";
$details_submit = mysqli_query($con, $details_insertion_query) or die(mysqli_error($con));

$sql3 = mysqli_query($con, "SELECT no_of_people FROM plan_details WHERE user_id= $id AND id=$plan_id");
$req = mysqli_fetch_assoc($sql3);
$number = $req['no_of_people'];
while ($number>0)
{
    $name = $_POST[$number];
    $insert=mysqli_query($con, "INSERT INTO names(user_id,plan_id,name) VALUES ('$id', '$plan_id', '$name')");   

$number = $number-1;
}
unset($_SESSION['plan_id']);
header('location: home_page.php');
?>



