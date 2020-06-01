<?php
require 'includes/common.php';
$name= mysqli_real_escape_string($con,$_POST['name']); 
$email= mysqli_real_escape_string($con,$_POST['e-mail']); 
$phone = $_POST['phone'];
$password= $_POST['password'];
if (strlen($password) < 6)
{
    echo "<span> Password must be atleast 6 characters long. </span>";
} 
else
 {
$password=md5($password);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$regex_num = "/^[789][0-9]{9}$/";

$user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
$result = mysqli_num_rows($user);
if ($result>0)
{    
    echo "<script>alert('Email is already in use.')</script>";
    echo "<script>location.href='signup.php'</script>";
} 
 else if (!preg_match($regex_email, $email))
  {
    $error_m = "<span>Not a valid Email Id</span>";
    header('location: signup.php?m1=' . $error_m);
  } else if (!preg_match($regex_num, $phone)) 
  {
    $error_m = "<span>Not a valid phone number</span>";
    header('location: signup.php?m2=' . $error_m);
  } 
else 
{
$user_registration_query = "INSERT into users(name,email,password,phone) values ('$name','$email','$password','$phone')";
$user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
$user_id = mysqli_insert_id($con);
$_SESSION['email'] = $email;
$_SESSION['user_id'] = $user_id;
session_start();
header('location:home_page.php');
}
}
?>