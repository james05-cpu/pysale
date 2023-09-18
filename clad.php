<?php
include('conn.php');
session_start();
$clicker=$_SESSION['username'];
$aid=$_GET['aid'];
$stmt=$conn->prepare("INSERT INTO AD_CLICKS (aid,clicker) VALUES (?,?)");
$stmt->bindValue(1,$aid);
$stmt->bindValue(2,$clicker);
$stmt->execute();
?>