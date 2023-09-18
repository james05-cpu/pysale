<?php
session_start();
include('conn.php');
$hid=$_GET['hid'];
$uid=$_SESSION['username']
if($uid==null){
header("Location:index.php");
exit;
}
$stm=$conn->prepare("DELETE from HIST where `username`=? and hid=?);
$stm->bindValue(1,$uid);
$stm->bindValue(2,$hid);
$stm->execute();

header("Location:desk.php");
?>
