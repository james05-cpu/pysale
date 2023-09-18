<?php
include('conn.php');
session_start();
$hid=$_GET['hid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$stm=$conn->prepare("DELETE FROM `HIST`  where `username`=? and `hid`=?") ;
$stm->bindValue(1,$uid);
$stm->bindValue(2,$hid);
$stm->execute();
header("Location:hist.php");
?>
