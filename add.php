<?php
include('product.php');
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid===null){
header("Location:index.php");
exit;

}

   if(isset($_FILES['image'])){
$salt=rand(99,99999);
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
     if(!getimagesize($file_tmp)){
      echo "Invalid Image File";
      exit;
     }
    
$new_name=$salt .$file_name;
$username=$_SESSION['username'];
$file_store="upload/${username}/".$new_name;
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){

         move_uploaded_file($file_tmp, $file_store);
    
      }else{
         echo "Invalid Image";
         exit;
      }

      $name=SQLite3::escapeString(strip_tags($_POST['productname']));
     $username=$_SESSION['username'];
     $price=SQLite3::escapeString(strip_tags($_POST['price']));
     $instock=SQLite3::escapeString(strip_tags($_POST['instock']));
     $des=SQLite3::escapeString(strip_tags($_POST['des']));

     $product=new Product($username,$name,$des,$price,$file_store,$instock);
if($product->isValid()){
   $stm=$conn->prepare("INSERT INTO `PRODUCTS` (username, productname,price,instock, des, imgsrc)VALUES(:1,:2,:3,:4,:5,:6)");
   $stm->bindValue(':1',$username);
   $stm->bindValue(':2',$name);
   $stm->bindValue(':3',$price);
   $stm->bindValue(':4',$instock);
   $stm->bindValue(':5',$des);
   $stm->bindValue(':6',$file_store);
   $stm->execute();
   header("Location:products.php");
}

}
?>
