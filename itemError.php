<?php
include('conn.php');
session_start();
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
$tm=time();
$time="20".date("y-m-d",$tm);
function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    $ip = getIPAddress();  
  $stm=$conn->prepare("INSERT INTO `INC` (username, ip,tm)VALUES(:1,:2,:3)");
$stm->bindValue(':1',$username);
$stm->bindValue(':2',$ip);
$stm->bindValue(':3',$time);
$stm->execute();
echo "An Error occured Try again";

?>
