<?php
require 'includes/common.php';
$initial_budget = $_POST['budget'];
$people = $_POST['people'];
if ($initial_budget < 0)
{
    echo "<script>alert('Initial Budget has to be positive.')</script>";
    echo "<script>location.href='create_new_plan.php'</script>";
}
else if ($people < 0)
{
    echo "<script>alert('No of people cannot be negative.')</script>";
    echo "<script>location.href='create_new_plan.php'</script>";
}
else 
{   $email = $_SESSION['email'];
    $user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
    $result = mysqli_fetch_assoc($user);
    $id = $result['id'];
    $plan_insertion = "INSERT into plan_details(user_id,initial_budget,no_of_people) values ($id,$initial_budget,$people)";
    $user_insertion_submit = mysqli_query($con, $plan_insertion) or die(mysqli_error($con));
    $plan_id = mysqli_insert_id($con);
    $_SESSION['plan_id']=$plan_id;
    header('location:plan_details.php');
}
?>