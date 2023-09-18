<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$stm=$conn->prepare("DELETE from HIST where `username`=?");
$stm->bindValue(1,$uid);
$stm->execute();

header("Location:hist.php");
?>
