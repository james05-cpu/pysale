<?php 
session_start();
include('chatsystem.php');
include('auth.php');
    //if(isset($_SESSION['username'])){
      $sid = $_SESSION['username'];
     if($sid==null){
     header("Location:index.html");
     exit;
      }
      
$rid = $_SESSION['sid'];
$message =$_POST['message'];
$system=new ChatSystem();
$tm=time();
$time="20".date("y-m-d",$tm);
if($system->isValidInsert($sid,$rid,$message)){
     $sms_id=Auth::generateID(8);
     $system->addToSystem($sid,$rid);
     $system->configureNew($sid,$rid);
     $system->addMessageInfo($sid,$rid,$sms_id,$message,$time);
}  
?>
