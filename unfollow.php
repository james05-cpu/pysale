<?php
session_start();
include('conn.php');
$sid=$_GET['sid'];
$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.php");
exit;
}
$stm=$conn->prepare("DELETE FROM `FOLLOWERS`  where `follower_id`=? and `followed_id`=?") ;
$stm->bindValue(1,$bid);
$stm->bindValue(2,$sid);
$stm->execute();
header("Location:following.php");
?>
