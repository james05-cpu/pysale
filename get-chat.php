<?php 
    session_start();
    include('chatsystem.php');
    $sid = $_SESSION['username'];
    $rid = $_SESSION['sid'];
 
$system=new ChatSystem();
$tm=time();
$time="20".date("y-m-d",$tm);
if($system->isValidGet($sid,$rid)){
    $info= $system->retrieveChat($sid,$rid);
 echo $info;
}  
?>
