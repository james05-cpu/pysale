<?php
session_start();
include('conn.php');
$oid=$_SESSION['oid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$sms=SQLite3::escapeString(strip_tags($_POST['sms']));
if($uid==null){
header("Location:index.html");
exit;
}
$stm=$conn->prepare("UPDATE ORDERS SET `message`=? where `bid`=?  and `oid`=?");
$stm->bindValue(1,$sms);
$stm->bindValue(2,$uid);
$stm->bindValue(3,$oid);
$stm->execute();
header("Location:orders.php");
?>