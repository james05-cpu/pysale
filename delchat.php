<?php
include('conn.php');
session_start();
$cid=$_GET['cid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$stm=$conn->prepare("DELETE FROM `CHATS`  where `sid`=? and `rid`=? or `sid`=? and `rid`=?" ) ;
$stm->bindValue(1,$uid);
$stm->bindValue(2,$cid);
$stm->bindValue(3,$cid);
$stm->bindValue(4,$uid);
$stm->execute();
//header("Location:dashboard.php");
exit;
?>
