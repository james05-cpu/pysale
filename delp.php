<?php
include('conn.php');
session_start();
$pname=$_GET['productname'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$stm=$conn->prepare("DELETE FROM `PRODUCTS`  where `username`=? and `productname`=?") ;
$stm->bindValue(1,$uid);
$stm->bindValue(2,$pname);
$stm->execute();
header("Location:products.php");
?>
