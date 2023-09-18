<?php
session_start();
include('conn.php');
include('shopinfo.php');
include('auth.php');
include('settingsinfo.php');
include('walletinfo.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$bal=100;
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
      $file_ext=strtolower(end(explode('.',$file_name)));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_store);
        // echo "Success";
      }else{
         //print_r($errors);
echo "Invalid Image";
exit;
     
}
$name=SQLite3::escapeString(strip_tags($_POST['fullname']));
$username=$_SESSION['username'];
     $storename=SQLite3::escapeString(strip_tags($_POST['storename']));
     $loc=SQLite3::escapeString(strip_tags($_POST['loc']));
     $des=SQLite3::escapeString(strip_tags($_POST['des']));

$id=rand(999,999999999);
$htm=time();
$cid=Auth::generateID(9);
$b1="on";
$b2="on";
$b3="on";
$shop=new ShopInfo($cid,$storename,$des,$loc,$file_store,$username,$name);
if($shop->isValid()){
   $stm=$conn->prepare("INSERT INTO `USERINFO` (username,fullname,storename,loc, des, imgsrc, cid)VALUES(:1,:2,:3,:4,:5,:6,:7)");
   $stm->bindValue(':1',$username);
   $stm->bindValue(':2',$name);
   $stm->bindValue(':3',$storename);
   $stm->bindValue(':4',$loc);
   $stm->bindValue(':5',$des);
   $stm->bindValue(':6',$file_store);
   $stm->bindValue(':7',$cid);
   $stm->execute();
   
}

$setting=new SettingInfo($username,$b1,$b2,$b3);
if($setting->isValid()){
   $stm=$conn->prepare("INSERT INTO `SETTINGS` (username, followingtext, followertext, customertext)VALUES(:1,:2,:3,:4)");
   $stm->bindValue(':1',$username);
   $stm->bindValue(':2',$b1);
   $stm->bindValue(':3',$b2);
   $stm->bindValue(':4',$b3);
   $stm->execute();

}
$wallet=new WalletInfo($username,$bal);
if($wallet->isValid()){
   $stm=$conn->prepare("INSERT INTO `WALLET` (wid, bal)VALUES(:1,:2)");
   $stm->bindValue(':1',$username);
   $stm->bindValue(':2',$bal);
   $stm->execute();
   $stm->close();
   header("Location:dashboard.php");
}
}
?>
