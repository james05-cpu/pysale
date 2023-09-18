<?php
session_start();
include('conn.php');
$name=$_GET['name'];
$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.php");
exit;
}

$stm=$conn->prepare("INSERT INTO `CLICKED_SHOP` (seller,buyer) VALUES(?,?)" ) ;
$stm->bindValue(1,$bid);
$stm->bindValue(2,$name);
$stm->execute();

?>