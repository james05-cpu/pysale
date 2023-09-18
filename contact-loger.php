<?php
include('auth.php');
include('contactinfo.php');
session_start();
include('conn.php');
     $name=SQLite3::escapeString($_POST['name']);
     $email=SQLite3::escapeString($_POST['email']);
     $sub=SQLite3::escapeString($_POST['sub']);
     $message=SQLite3::escapeString($_POST['des']);

$info=new ContactInfo($email,$name,$sub,$message);
if($info->isValid()){
     $code=Auth::generateID(6);
     $stm=$conn->prepare("INSERT INTO `QUERIES` (name,email,subject,message,quid)VALUES(:1,:2,:3,:4,:5)");
     $stm->bindValue(':1',$name);
     $stm->bindValue(':2',$email);
     $stm->bindValue(':3',$sub);
     $stm->bindValue(':4',$message);
     $stm->bindValue(':5',$code);
     $stm->execute();
}
header("Location:dashboard.php");

?>