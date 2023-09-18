<?php
include('conn.php');
session_start();
$username=$_SESSION['username'];
$b1="OFF";
$b2="OFF";
$b3="OFF";

if(isset($_POST['b1'])){
    $b1=SQLite3::escapeString($_POST['b1']);
}
 if(isset($_POST['b2'])){
    $b2=SQLite3::escapeString($_POST['b2']);
}
if(isset($_POST['b3'])){
    $b1=SQLite3::escapeString($_POST['b3']);
}

$stm=$conn->prepare("UPDATE `SETTINGS` set followingtext=?, followertext=?, customertext=? where username=?");
$stm->bindValue(1,$b1);
$stm->bindValue(2,$b2);
$stm->bindValue(3,$b3);
$stm->bindValue(4,$username);
$stm->execute();

header("Location:dashboard.php");
?>