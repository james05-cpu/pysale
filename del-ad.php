<?php
include('conn.php');
session_start();
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$stm=$conn->prepare("DELETE FROM `ADS`  where `username`=?") ;
$stm->bindValue(1,$uid);
$stm->execute();
header("Location:dashboard.php");
exit;
?>
