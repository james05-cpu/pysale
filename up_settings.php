<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$username=$_SESSION['username'];

$category = strip_tags($_POST['cate']);

switch ($category) {
  case "image": 
   if(isset($_FILES['image'])){
$salt=rand(99,99999);
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
$new_name=$salt .$file_name;
$nam=$_SESSION['username'];
 $file_store="upload/${nam}/".$new_name;
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_store);
      
        $stm=$conn->prepare("UPDATE `USERINFO` set  imgsrc=? where username=? ");
       $stm->bindValue(1,$file_store);
              $stm->bindValue(2,$username);
              $stm->execute();

$stm=$conn->prepare("UPDATE `FOLLOWERS` set followed_image=? where followed_id=?  ");
$stm->bindValue(1,$file_store);
$stm->bindValue(2,$username);
$stm->execute();

$stm=$conn->prepare("UPDATE `FOLLOWERS` set follower_image=? where follower_id=?  ");
$stm->bindValue(1,$file_store);
$stm->bindValue(2,$username);
$stm->execute();

      }

      else{
      echo "Invalid Image";
          exit;
      }
   }
    break;


  case "storename":
    $storename=strip_tags($_POST['storename']);
  $stm=$conn->prepare("UPDATE `USERINFO` set  storename=? where username=? ");
       $stm->bindValue(1,$storename);
              $stm->bindValue(2,$username);
              $stm->execute();
break;

  case "fullname":
   $name=strip_tags($_POST['fullname']);
    $stm=$conn->prepare("UPDATE `USERINFO` set  fullname=? where username=? ");
       $stm->bindValue(1,$name);
              $stm->bindValue(2,$username);
              $stm->execute();
    break;


 case "loc":
   $loc=strip_tags($_POST['loc']);
    $stm=$conn->prepare("UPDATE `USERINFO` set  loc=? where username=? ");
       $stm->bindValue(1,$loc);
              $stm->bindValue(2,$username);
              $stm->execute();
    break;


case "des":
   $des=strip_tags($_POST['des']);
    $stm=$conn->prepare("UPDATE `USERINFO` set  des=? where username=? ");
       $stm->bindValue(1,$des);
              $stm->bindValue(2,$username);
              $stm->execute();
    break;

case "email":
   $email=strip_tags($_POST['email']);
    $stm=$conn->prepare("UPDATE `USERS` set  email=? where username=? ");
       $stm->bindValue(1,$email);
              $stm->bindValue(2,$username);
              $stm->execute();
    break;

case "phone":
   $phone=strip_tags($_POST['phone']);
    $stm=$conn->prepare("UPDATE `USERS` set  phone=? where username=? ");
       $stm->bindValue(1,$phone);
              $stm->bindValue(2,$username);
              $stm->execute();
    break;


  default:
}
header("Location:profile.php");

?>
