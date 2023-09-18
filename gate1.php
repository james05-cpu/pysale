<?php
session_start();
$uid=$_POST['username'];
$_SESSION['sid']=$uid;
echo "connected";
header("Location:store.php");
?>
