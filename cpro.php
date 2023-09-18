<?php
session_start();
include('conn.php');
$name=$_GET['name'];
$price=$_GET['price'];
$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.php");
exit;
}
$sid=$_SESSION['sid'];
if ($sid==$bid) {
	header("Location:home.php");
	exit;
}

$stm=$conn->prepare("INSERT INTO `CLICKED_PRODUCTS` (username,clicker,product,price) VALUES(?,?,?,?)" ) ;
$stm->bindValue(1,$sid);
$stm->bindValue(2,$bid);
$stm->bindValue(3,$name);
$stm->bindValue(4,$price);
$stm->execute();

?>