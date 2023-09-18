<?php
session_start();
include('conn.php');

$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.php");
exit;
}
$sid=$_SESSION['sid'];
if ($sid==$bid) {
	header("Location:home.php");
	exit;
}
header("Content-Type:application/json");
$cart=$_POST['cart'];
$formatedname=str_replace("\"name\":","<td> ",$cart);
$formatedprice=str_replace("\"price\":","<td>",$formatedname);
$formatedquotes=str_replace("\"quad\":","<td>",$formatedprice);
$formatedlbrac=str_replace("{","<tr>",$formatedquotes);
$formatedrbrac=str_replace("},","</td></tr>",$formatedlbrac);
$formatedebrac=str_replace("}"," ",$formatedrbrac);
$formatedcoma=str_replace(",","</td>",$formatedebrac);
$final=str_replace("\""," ",$formatedcoma)."</td></tr>";

$id=rand(999,999999999);
$tm=time();
$oid=$id+$tm;
$_SESSION['oid']=$oid;
$time="20".date("y-m-d",$tm);
$status="pending";
$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$bid);
$res=$stm->execute();
$fullname="";
$fullname1="";
while( $row=$res->fetchArray()){
$fullname=$fullname.$row['fullname'];
}
$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$sid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$fullname1=$fullname1.$row['fullname'];
}
$stm=$conn->prepare("INSERT INTO `ORDERS` (oid,seller,buyer,orderinfo, time, bid, status,sid)VALUES(:1,:2,:3,:4,:5,:6,:7,:8)");
$stm->bindValue(':1',$oid);
$stm->bindValue(':2',$sid);
$stm->bindValue(':3',$fullname);
$stm->bindValue(':4',$final);
$stm->bindValue(':5',$time);
$stm->bindValue(':6',$bid);
$stm->bindValue(':7',$status);
$stm->bindValue(':8',$sid);
$stm->execute();


$id=rand(999,999999999);
$hid=$id+$tm;
$time="20".date("y-m-d",$tm);
$action="Placed order on ".$fullname1." shop";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$bid);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();


$id=rand(999,999999999);
$hid=$id+$tm;
$time="20".date("y-m-d",$tm);
$action=$fullname." Placed order on your shop";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$sid);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();
header("Location:text.html");
?>
