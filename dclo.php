<?php
include('conn.php');
session_start();
$oid=$_GET['oid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$status="Rejected";

$stm=$conn->prepare("UPDATE `ORDERS` set `status`=? where `sid`=? and `oid`=?") ;
$stm->bindValue(1,$status);
$stm->bindValue(2,$uid);
$stm->bindValue(3,$oid);
$stm->execute();
$stm=$conn->prepare("SELECT* FROM ORDERS where `sid`=? and `oid`=?");
$stm->bindValue(1,$uid);
$stm->bindValue(2,$oid);
$res=$stm->execute();
$fullname="";
while( $row=$res->fetchArray()){
$fullname=$fullname.$row['buyer'];
}
$id=rand(999,999999999);
$htm=time();
$hid=$id+$htm;
$time="20".date("y-m-d",$htm);
$action="You rejected  ".$fullname."'s"." order";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$uid);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();
header("Location:orders.php");
?>



