<?php
include('conn.php');
session_start();
$productname=SQLite3::escapeString(strip_tags($_GET['name']));
$price=SQLite3::escapeString(strip_tags($_GET['prc']));
$des=SQLite3::escapeString(strip_tags($_GET['des']));
$uid=$_SESSION['username'];

if($productname==null ||$des==null || $price==null){
header("Location:itemError.php");
exit;
}
$stm=$conn->prepare("UPDATE `PRODUCTS` SET `price`=?,`des`=? where `username`=? and `productname`=?") ;
$stm->bindValue(1,$price);
$stm->bindValue(2,$des);
$stm->bindValue(3,$uid);
$stm->bindValue(4,$productname);
$stm->execute();
header("Location:products.php");
?>
