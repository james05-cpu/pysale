<?php 
    session_start();
include('conn.php');
    //if(isset($_SESSION['username'])){
        $sid = $_SESSION['username'];
     if($sid==null){
     header("Location:index.php");
     exit;
      }
  $message =$_POST['message'];

       /* $rid = $_SESSION['receiver'];
if($rid==null){
header("Location:recError.php");
exit;
}*/
$filtered=array();
$filter="on";
$followers=array();
$stm=$conn->prepare("SELECT * FROM FOLLOWERS where followed_id=?");
$stm->bindValue(1, $sid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
        array_push($followers, $row['follower_id']);

               }

               $tm=time();
        $time="20".date("y-m-d",$tm);

foreach($followers as $receiver){
$stm = $conn->prepare("SELECT * FROM SETTINGS where username=? and followertext=?");
$stm->bindValue(1, $receiver);
$stm->bindValue(2, $filter);

$res=$stm->execute();
while( $row=$res->fetchArray()){

        array_push($filtered, $row['username']);
   
               }


}


foreach($filtered as $receiver){
    $chat = $conn->query("SELECT COUNT(*) as count FROM CHATS where sid= '$sid' and rid='$receiver'");
$chated = $chat->fetchArray();
$chatcount = $chated['count'];
$c=1;
if ($chatcount<$c) {
     $stm=$conn->prepare("INSERT INTO CHATS (sid,rid) VALUES (:1,:2)");
     $stm->bindValue(':1',$sid);
$stm->bindValue(':2',$receiver);
$stm->execute();
}
}

foreach($filtered as $receiver){
    $chat1 = $conn->query("SELECT COUNT(*) as count FROM CHATS where  sid='$receiver' and rid='$sid'");
$chated1 = $chat1->fetchArray();
$chatcount1 = $chated1['count'];
$c1=1;
if ($chatcount1<$c1) {
     $stm=$conn->prepare("INSERT INTO CHATS (rid,sid) VALUES (:1,:2)");
     $stm->bindValue(':1',$sid);
$stm->bindValue(':2',$receiver);
$stm->execute();
}
}


foreach($filtered as $receiver){
$nchat = $conn->query("SELECT COUNT(*) as count FROM NEW_CHAT where sid= '$sid' and rid='$receiver'");
$nchated = $nchat->fetchArray();
$nchatcount = $nchated['count'];
$nc=1;
if ($nchatcount<$nc) {
     $stm=$conn->prepare("INSERT INTO NEW_CHAT (sid,rid) VALUES (:1,:2)");
     $stm->bindValue(':1',$sid);
$stm->bindValue(':2',$receiver);
$stm->execute();
}

}

foreach($filtered as $receiver){
    $nchat1 = $conn->query("SELECT COUNT(*) as count FROM NEW_CHAT where rid= '$sid' and sid='$receiver'");
$nchated1 = $nchat1->fetchArray();
$nchatcount1 = $nchated1['count'];
$nc1=1;
if ($nchatcount1<$nc1) {
     $stm=$conn->prepare("INSERT INTO NEW_CHAT (sid,rid) VALUES (:1,:2)");
     $stm->bindValue(':1',$sid);
$stm->bindValue(':2',$receiver);
$stm->execute();
}
}
      
   foreach($filtered as $receiver){
   $stm=$conn->prepare("INSERT INTO MESSAGES (sid,rid,sms_id,sms,tm)VALUES(:1,:2,:3,:4,:5)");
$stm->bindValue(':1',$sid);
$stm->bindValue(':2',$receiver);
$stm->bindValue(':3',$tm);
$stm->bindValue(':4',$message);
$stm->bindValue(':5',$time);
$stm->execute();
        
}
     header("Location:dashboard.php");
  
?>
