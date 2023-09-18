<?php
session_start();
if ($_GET['sid']==null) {
	header("Location:home.php");
	exit;
}
$sid=$_GET['sid'];
$_SESSION['sid']=$sid;
if(isset($_SESSION['cart_item'])){
	unset($_SESSION["cart_item"]);
}
header("Location:shop.php");
?>