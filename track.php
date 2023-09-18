<?php

include('con.php');
session_start();
$username=$_SESSION['username'];
$id=rand(999,999999999);
$htm=time();
$hid=$id+$htm;
$time="20".date("y-m-d",$tm);
$action="Ordered products from "."";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$username);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();
header("Location:stepto.php");

?>
