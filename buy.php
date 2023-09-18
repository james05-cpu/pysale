<?php
session_start();
include('conn.php');
include('order.php');
include('activity.php');
$bid=$_SESSION['username'];
if($bid==null){
header("Location:index.html");
exit;
}
$sid=$_SESSION['sid'];
if ($sid==$bid) {
        header("Location:home.php");
        exit;
}
$total_quantity=0;
$total_price=0;
$items="";
$entity="";
$row_start="<tr>";
$row_end="</tr>";
$add_data="<td>";
$end_data="</td>";
foreach ($_SESSION["cart_item"] as $item){
        $name=$item["name"];
        $price=$item["price"];
        $sub=$item_price = $item["quantity"]*$item["price"];
        $quad=$item["quantity"];
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
        $entity=$row_start.$add_data.$name.$end_data.$add_data.$sub.$end_data.$add_data.$quad.$end_data.$row_end;
        $items=$items.$entity;
                }

                $items=$items.$row_start.$add_data."Total".$end_data.$add_data.$total_price.$end_data.$add_data.$total_quantity.$end_data.$row_end;
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
$order=new Order($oid,$sid,$fullname,$items,$time,$bid,$status,$sid);

if($order->isValid()){
        $stm=$conn->prepare("INSERT INTO `ORDERS` (oid,seller,buyer,orderinfo, time, bid, status,sid)VALUES(:1,:2,:3,:4,:5,:6,:7,:8)");
        $stm->bindValue(':1',$oid);
        $stm->bindValue(':2',$sid);
        $stm->bindValue(':3',$fullname);
        $stm->bindValue(':4',$items);
        $stm->bindValue(':5',$time);
        $stm->bindValue(':6',$bid);
        $stm->bindValue(':7',$status);
        $stm->bindValue(':8',$sid);
        $stm->execute();
}

$id=rand(999,999999999);
$hid=$id+$tm;
$time="20".date("y-m-d",$tm);
$action="Placed order on ".$fullname1." shop";
$activity=new Activity($hid,$fullname1,$action,$time);
if($activity->isValid()) {

    $stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
    $stm->bindValue(':1', $hid);
    $stm->bindValue(':2', $bid);
    $stm->bindValue(':3', $action);
    $stm->bindValue(':4', $time);
    $stm->execute();
}

$id=rand(999,999999999);
$hid=$id+$tm;
$time="20".date("y-m-d",$tm);
$action=$fullname." Placed order on your shop";
$activity1=new Activity($hid,$fullname,$action,$time);
if($activity->isValid()) {
    $stm=$conn->prepare("INSERT INTO `HIST` (hid, username,action,time)VALUES(:1,:2,:3,:4)");
    $stm->bindValue(':1', $hid);
    $stm->bindValue(':2', $sid);
    $stm->bindValue(':3', $action);
    $stm->bindValue(':4', $time);
    $stm->execute();
}
header("Location:text.html");
?>