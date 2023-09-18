<?php
session_start();
include('conn.php');
$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.php");
exit;
}
$sid=$_GET['sid'];
$aid=$_GET['aid'];
/*if ($sid==$bid) {
	header("Location:home.php");
	exit;
}*/
$id=rand(999,999999999);
$tm=time();
$i="<tr><td>".$aid. " </td><td>Trendings</td></tr>";
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
$stm->bindValue(':4',$i);
$stm->bindValue(':5',$time);
$stm->bindValue(':6',$bid);
$stm->bindValue(':7',$status);
$stm->bindValue(':8',$sid);
$stm->execute();


$id=rand(999,999999999);
$hid=$id+$tm;
$action="Placed order on ".$fullname1." shop";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)
	VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$bid);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();


$id=rand(999,999999999);
$hid=$id+$tm;
$action=$fullname." Placed order on your shop";
$stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)
	VALUES(:1,:2,:3,:4)");
$stm->bindValue(':1',$hid);
$stm->bindValue(':2',$sid);
$stm->bindValue(':3',$action);
$stm->bindValue(':4',$time);
$stm->execute();

$stm=$conn->prepare("INSERT INTO PURCHASED_AD (aid,bid)
	VALUES(:1,:2)");
$stm->bindValue(':1',$aid);
$stm->bindValue(':2',$bid);
$stm->execute();

$settled=array();
$root="";
$sign="";
$stm=$conn->prepare("SELECT* FROM REFS where `refid`=?");
$stm->bindValue(1,$bid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$sign=$row['sign'];
	}

$stm=$conn->prepare("SELECT* FROM REFS where `sign`=?");
$stm->bindValue(1,$sign);
$res1=$stm->execute();
while( $row=$res1->fetchArray()){
array_push($settled, $row['refid']);
$root=$row['referer'];
	}
array_push($settled, $root);

$stm=$conn->prepare("INSERT INTO PURCHASED_AD (aid,bid)
	VALUES(:1,:2)");
$stm->bindValue(':1',$aid);
$stm->bindValue(':2',$bid);
$stm->execute();

$previous=array();
$stm=$conn->prepare("SELECT* FROM WALLET where wid=?");
$stm->bindValue(1,$settled[$i]);
$res=$stm->execute();
while( $row=$res->fetchArray()){
array_push($previous,$row['bal']);
}
$current=array();
foreach($previous as $ref){
array_push($current, $ref+10);
}
for ($i=0; $i <count($settled) ; $i++) { 
	for ($j=0; $j <count($current) ; $j++) { 
		
	}
$stm=$conn->prepare("UPDATE WALLET SET bal=? where wid=?");
$stm->bindValue(1,$current[$i]);
$stm->bindValue(2,$settled[$i]);
$res=$stm->execute();
}

foreach($settled as $ref){
$stm=$conn->prepare("INSERT INTO AD_BLACKLIST (aid,refid)
	VALUES(:1,:2)");
$stm->bindValue(':1',$aid);
$stm->bindValue(':2',$ref);
$stm->execute();
}
$topay=$settled;
foreach($topay as $ref){

$res=$conn->query("SELECT* FROM USERINFO where username='$ref'" );
while( $row=$res->fetchArray()){
}
}
?>
