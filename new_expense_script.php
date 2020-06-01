<?php
require 'includes/common.php';
if (isset($_POST['submit']))
{ 
    $title = $_POST['title']; 
    $date = $_POST['date'];
    $spent = $_POST ['spent'];
    $plan_id = $_POST['id'];
    $email=$_SESSION['email'];
    $by_person = $_POST['choice'];
    $user= mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
    $result = mysqli_fetch_assoc($user);
    $id = $result['id'];
    
    function GetImageExtension($imagetype)
    {
    if (empty($imagetype))  return false;
     switch($imagetype)                                                                                                   
       {
           case 'image/bmp' : return '.bmp';
           case 'image/gif' : return '.gif';
           case 'image/jpeg' : return '.jpg';
           case 'image/png' : return '.png';
           default : return false;
       
     }
    }
    if (!empty($_FILES["bill"]["name"]))
    { 
     $file_name= $_FILES["bill"]["name"];
     $temp_name =$_FILES["bill"]["tmp_name"];
     $imgtype= $_FILES["bill"]["type"];
     $ext=GetImageExtension($imgtype);
     $imagename=date("d-m-Y")."-".time().$ext;
     $target_path= "img/".$imagename;
     echo $target_path . "<br />" . $imagename . "<br /> " . $ext;
     if (move_uploaded_file($temp_name,$target_path))
     {
        $myqry = "INSERT INTO new_expense(user_id, plan_id, title, date, by_person, spent,bill) VALUES ('$id','$plan_id','$title','$date','$by_person', '$spent','$target_path')";
        $insert = mysqli_query($con, $myqry);
        
     }
     
    } 
    else
    {
        $myqry = "INSERT INTO new_expense(user_id, plan_id, title, date, by_person, spent) VALUES ('$id','$plan_id','$title','$date','$by_person', '$spent')";
        $insert = mysqli_query($con, $myqry);
    } 
  
    header("location:viewplan.php?id=".htmlspecialchars($plan_id));
}


// $string = $_POST['bill'];
// $array = explode('.', $string);
// $filename = $array[0];
// $file_extension = $array[1];
?>