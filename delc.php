<?php
include('conn.php');
session_start();
$oid=$_GET['oid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$stm=$conn->prepare("DELETE FROM `CHATS`  where `sid`=? and `rid`=?" or  `sid`=? and `rid`=?") ;
$stm->bindValue(1,$uid);
$stm->bindValue(2,$oid);
$stm->bindValue(1,$oid);
$stm->bindValue(2,$uid);
$stm->execute();
?>
