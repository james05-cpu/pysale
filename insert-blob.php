<?php
session_start();
include('conn.php');
include('adsystem.php');
$uid=$_SESSION['username'];
if($uid===null){
header("Location:index.php");
exit;
}

function Error($message)
{
   echo('<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Code | Error</title>
       <style>
           h1{
               padding: 16px;
           }
           body{
               width: 100%;
               justify-content: center;
               align-items: center;
               align-content: center;
           }
           h1{
               padding: 16px;
           }
       
           p{
             font-size: 17px;
             font-weight: 400;
             padding-left: 16px;
           }
           p a{
               text-decoration: none;
               color: white;
               background-color: royalblue;
               padding: 8px 60px;
               border-radius: 30px;
               font-size: 18px;
           }
           .link{
               margin-top: 30px;
           }
           p a:hover{
               opacity: 0.7;
               color: #000;
           }
       </style>
   </head>
   <body>
       <div class="containter">
           <h1>pySale Acounts</h1>
           <p>Hello user, we could not complete your request</p>
           <p>We have encountered an error</p>
           <p>'.$message.'</p>
           <p class="link"><a href="blob.php">Try Again</a></p>
       </div>
   </body>
   </html>');
}

   if(isset($_FILES['front'])){
$salt=rand(99,99999);
      $errors= array();
      $file_name = $_FILES['front']['name'];
      $file_size =$_FILES['front']['size'];
      $file_tmp =$_FILES['front']['tmp_name'];
      $file_type=$_FILES['front']['type'];
$new_name=$salt .$file_name;
$username=$_SESSION['username'];
 $file_store1="upload/${username}/".$new_name;
      $file_ext=strtolower(end(explode('.',$_FILES['front']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp, $file_store1);
         
      }else{
         Error($error[0]);
         exit;
      }
}


  if(isset($_FILES['side'])){
$salt=rand(99,99999);
      $errors= array();
      $file_name = $_FILES['side']['name'];
      $file_size =$_FILES['side']['size'];
      $file_tmp =$_FILES['side']['tmp_name'];
      $file_type=$_FILES['side']['type'];
$new_name=$salt .$file_name;
$username=$_SESSION['username'];
 $file_store2="upload/${username}/".$new_name;
      $file_ext=strtolower(end(explode('.',$_FILES['side']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp, $file_store2);
               }else{
                  Error($error[0]);
         exit;
      }
}

if(isset($_FILES['top'])){
$salt=rand(99,99999);
      $errors= array();
      $file_name = $_FILES['top']['name'];
      $file_size =$_FILES['top']['size'];
      $file_tmp =$_FILES['top']['tmp_name'];
      $file_type=$_FILES['top']['type'];
$new_name=$salt .$file_name;
$username=$_SESSION['username'];
 $file_store3="upload/${username}/".$new_name;
      $file_ext=strtolower(end(explode('.',$_FILES['top']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp, $file_store3);
        
      }else{
         Error($error[0]);
         exit;
      }
}
$system=new AdSystem();

$username=$_SESSION['username'];
$rawaid=$_SESSION['rawid'];
if($system->isValidBlob($username,$rawaid,$file_store1,$file_store2,$file_store3)){
   $stm=$conn->prepare("UPDATE `ADS` SET front=?, side=? ,top=? where aid='$rawaid' and username='$uid'");
   $stm->bindValue(1,$file_store1);
   $stm->bindValue(2,$file_store2);
   $stm->bindValue(3,$file_store3);
   $stm->execute();
   header("Location:pay.html");
}
else{
   $message=$system->getError();
   Error($message);
   exit;
}

?>

