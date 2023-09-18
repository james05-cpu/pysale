<?php
include('conn.php');
session_start();
$follower_id=$_SESSION['username'];
$followed_id=$_GET['sid'];

$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$follower_id);
$res=$stm->execute();
$fullname="";
$bimg="";
while( $row=$res->fetchArray()){
$fullname=$fullname.$row['fullname'];
$bimg=$bimg.$row['imgsrc'];
}

$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$followed_id);
$res=$stm->execute();
$seller="";
$simg="";
while( $row=$res->fetchArray()){
$seller=$seller.$row['fullname'];
$simg=$simg.$row['imgsrc'];
}

$stm=$conn->prepare("INSERT INTO `FOLLOWERS`(follower_id, followed_id, follower_name,followed_name,follower_image,followed_image)
values(?,?,?,?,?,?)") ;
$stm->bindValue(1,$follower_id);
$stm->bindValue(2,$followed_id);
$stm->bindValue(3,$fullname);
$stm->bindValue(4,$seller);
$stm->bindValue(5,$bimg);
$stm->bindValue(6,$simg);
$stm->execute();
header("Location:followed.php");
?>
