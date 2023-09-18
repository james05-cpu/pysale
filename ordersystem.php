<?php
class OrderSystem{
/**
 * Class constructor.
 */
public $connection_orders;
public function __construct()
{
    $this->connection_orders=new SQLite3('data.sq3');
}
public function isValidStatus($id,$seller,$status):bool
{
    if(empty($id)){
        return false;
       }
       if(empty($status)){
        return false;
       }
       if(empty($seller)){
        return false;
       }
       return true;
}
public function isValidOrder($id,$seller,$order):bool{
if(empty($id)) {
    return false;
}
if(empty($order)) {
    return false;
}
if(empty($seller)) {
    return false;
}
return true;
}
function updateStatus($oid,$uid,$status){
    $stm=$this->connection_orders->prepare("UPDATE `ORDERS` set `status`=? where `sid`=? and `oid`=?") ;
    $stm->bindValue(1,$status);
    $stm->bindValue(2,$uid);
    $stm->bindValue(3,$oid);
    $stm->execute();
}
function getBuyerName($oid,$uid){
    $stm=$this->connection_orders->prepare("SELECT* FROM ORDERS where `sid`=? and `oid`=?");
    $stm->bindValue(1,$uid);
    $stm->bindValue(2,$oid);
    $res=$stm->execute();
    $fullname="";
    while( $row=$res->fetchArray()){
    $fullname=$fullname.$row['buyer'];
    }
    return $fullname;
}
function getSellerName($oid,$uid){
    $stm=$this->connection_orders->prepare("SELECT* FROM ORDERS where `bid`=? and `oid`=?");
    $stm->bindValue(1,$uid);
    $stm->bindValue(2,$oid);
    $res=$stm->execute();
    $fullname="";
    while( $row=$res->fetchArray()){
    $fullname=$fullname.$row['seller'];
    }
    return $fullname;
}
function deleteOrder($oid,$uid){
    $stm=$this->connection_orders->prepare("DELETE FROM `ORDERS`  where `bid`=? and `oid`=?") ;
    $stm->bindValue(1,$uid);
    $stm->bindValue(2,$oid);
    $stm->execute();
}
} 
?>