<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$old_pwd = $_POST['old_password'];
$old_pwd = mysqli_real_escape_string($con, $old_pwd);
$old_pwd = MD5($old_pwd);

$new_pwd = $_POST['new_password'];
$new_pwd = mysqli_real_escape_string($con, $new_pwd);


$rep_pwd = $_POST['re_new_password'];
$rep_pwd = mysqli_real_escape_string($con, $rep_pwd);


$query = "SELECT email, password FROM users WHERE email ='" . $_SESSION['email'] . "'";
$result = mysqli_query($con, $query)or die($mysqli_error($con));
$row = mysqli_fetch_array($result);

$orig_pwd = $row['password'];
if ($new_pwd != $rep_pwd) {
    header('location: change_password.php?error=The two passwords don\'t match.');
} 
 if (strlen($rep_pwd) < 6)
{
    header('location: change_password.php?error=Password too small.');
} 

else {
    if ($old_pwd == $orig_pwd) {
        $rep_pwd = MD5($rep_pwd);
        $new_pwd = MD5($new_pwd);
        $query = "UPDATE  users SET password = '" . $new_pwd . "' WHERE email = '" . $_SESSION['email'] . "'";
        mysqli_query($con, $query) or die($mysqli_error($con));
        header('location: change_password.php?error=Password Updated Successfully');
    } else
        header('location: change_password.php?error=Wrong Old Password.');
}
?>
