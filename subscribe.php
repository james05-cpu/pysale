<?php
include('conn.php');
include('auth.php');
session_start();
 $email=SQLite3::escapeString($_POST['email']);
    $name=SQLite3::escapeString($_POST['name']);

$code=Auth::generateID(7);
$stm=$conn->prepare("INSERT INTO `SUBSCRIBERS` (email, name, sid)VALUES(:1,:2 ,:3)");
$stm->bindValue(':1',$email);
$stm->bindValue(':2',$name);
$stm->bindValue(':3',$code);
$stm->execute();
header("Location:home.php");

?>