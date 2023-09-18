<?php
include('conn.php');
include('ordersystem.php');
include('auth.php');
include('activity.php');
session_start();
$oid=$_GET['oid'];
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$status="Approved";
$system=new OrderSystem();
if($system->isValidStatus($oid,$uid,$status)){
    $system->updateStatus($oid,$uid,$status);
    $fullname= $system->getBuyerName($oid,$uid);
   
    $hid=Auth::generateID(8);
    $time="20".date("y-m-d",$htm);
    $action="You accepted ".$fullname."'s"." order";
    $activity=new Activity($hid,$uid,$action,$time);
    if($activity->isValid()){
        $stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
        $stm->bindValue(':1',$hid);
        $stm->bindValue(':2',$uid);
        $stm->bindValue(':3',$action);
        $stm->bindValue(':4',$time);
        $stm->execute();
    }
  
    header("Location:orders.php");
}

?>
