<?php
session_start();
include('conn.php');
include('auth.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.html");
exit;
}
$aid=$_GET['aid'];
$tm=time();
$sign=Auth::generateID(8);
$available=array();
$res=$conn->query("SELECT* FROM AD_BLACKLIST where aid='$aid'" );
while( $row=$res->fetchArray()){
array_push($available,$row['refid']);
}

$res=$conn->query("SELECT* FROM REFS where aid='$aid'" );
while( $row=$res->fetchArray()){
array_push($available,$row['refid']);
}

$chuck=array();
$stm=$conn->prepare("SELECT* FROM FOLLOWERS where `followed_id`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
	if (!in_array($row['followed_id'],$available)) {
if (!in_array($row['followed_id'], $chuck)) {
	array_push($chuck, $row['followed_id']);
}
}
}
$stm=$conn->prepare("SELECT* FROM FOLLOWERS where `follower_id`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
if (!in_array($row['followed_id'],$available)) {
if (!in_array($row['followed_id'], $chuck)) {
	array_push($chuck, $row['followed_id']);
}
}
}

foreach($chuck as $ref){
$stm=$conn->prepare("INSERT INTO REFS (referer, refid,aid,sign) 
	VALUES(?,?,?,?)");
$stm->bindValue(1,$uid);
$stm->bindValue(2,$ref);
$stm->bindValue(3,$aid);
$stm->bindValue(4,$sign);

$stm->execute();
}


?>
