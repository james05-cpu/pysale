<?php 
class ChatSystem{
    public $conn;
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->conn=new SQLite3('data.sq3');
    }
    public function isValidInsert($sid,$rid,$message):bool{
    if(empty($sid)||empty($rid)||empty($message)){
        return false;
    }
    return true;
    }
    public function isValidGet($sid,$rid):bool
    {
        if(empty($sid)||empty($rid)){
            return false;
        }
        return true;
    }
    public function isValidDEL($sid,$rid,$sms_id):bool{
        if(empty($sid)||empty($rid)||empty($sms_id)){
            return false;
        }
        return true;
        }
    public function addToSystem($sid,$rid)
    {
        $chat = $this->conn->query("SELECT COUNT(*) as count FROM CHATS where sid= '$sid' and rid='$rid'");
        $chated = $chat->fetchArray();
        $chatcount = $chated['count'];
        $c = 1;
        if ($chatcount < $c) {
            $stm = $this->conn->prepare("INSERT INTO CHATS (sid,rid) VALUES (:1,:2)");
            $stm->bindValue(':1', $sid);
            $stm->bindValue(':2', $rid);
            $stm->execute();
        }


        $chat1 = $this->conn->query("SELECT COUNT(*) as count FROM CHATS where  sid='$rid' and rid='$sid'");
        $chated1 = $chat1->fetchArray();
        $chatcount1 = $chated1['count'];
        $c1 = 1;
        if ($chatcount1 < $c1) {
            $stm = $this->conn->prepare("INSERT INTO CHATS (rid,sid) VALUES (:1,:2)");
            $stm->bindValue(':1', $sid);
            $stm->bindValue(':2', $rid);
            $stm->execute();
        }
    }
    public function configureNew($sid,$rid){
        $nchat = $this->conn->query("SELECT COUNT(*) as count FROM NEW_CHAT where sid= '$sid' and rid='$rid'");
        $nchated = $nchat->fetchArray();
        $nchatcount = $nchated['count'];
        $nc = 1;
        if ($nchatcount < $nc) {
            $stm = $this->conn->prepare("INSERT INTO NEW_CHAT (sid,rid) VALUES (:1,:2)");
            $stm->bindValue(':1', $sid);
            $stm->bindValue(':2', $rid);
            $stm->execute();
        }

        $nchat1 = $this->conn->query("SELECT COUNT(*) as count FROM NEW_CHAT where rid= '$sid' and sid='$rid'");
        $nchated1 = $nchat1->fetchArray();
        $nchatcount1 = $nchated1['count'];
        $nc1 = 1;
        if ($nchatcount1 < $nc1) {
            $stm = $this->conn->prepare("INSERT INTO NEW_CHAT (sid,rid) VALUES (:1,:2)");
            $stm->bindValue(':1', $sid);
            $stm->bindValue(':2', $rid);
            $stm->execute();
        }
    }
    public function addMessageInfo($sid,$rid,$sms_id,$message,$time){
        $stm=$this->conn->prepare("INSERT INTO MESSAGES (sid,rid,sms_id,sms,tm)VALUES(:1,:2,:3,:4,:5)");
        $stm->bindValue(':1',$sid);
        $stm->bindValue(':2',$rid);
        $stm->bindValue(':3',$sms_id);
        $stm->bindValue(':4',$message);
        $stm->bindValue(':5',$time);
        $stm->execute();
    }
    public function retrieveChat($sid,$rid)
    {
        $output = "";
        $stm=$this->conn->prepare("SELECT* FROM MESSAGES where `sid`=? and `rid`=?  or `sid`=? and `rid`=?");
 $stm->bindValue(1,$sid);
 $stm->bindValue(2,$rid);
 $stm->bindValue(3,$rid);
 $stm->bindValue(4,$sid);
 $res=$stm->execute();
 $i="\"";
 while( $row=$res->fetchArray()){
   $param='\''.$row['sms_id'].'\'';
                 if($row['sid'] === $sid){
                     $output .= '<div class="chat outgoing" id="'.$row['sms_id'].'" onclick="select('.$param.')">
                                 <div class="details">
                                     <p>'. $row['sms'] .'</p>
                                     <input type="hidden" class="id" value="'.$row['sms_id'].'">
                                 </div>
                                 </div>';
                 }else{
                     $output .= '<div class="chat incoming">
                                 <div class="details">
                                     <p>'. $row['sms'] .'</p>
                                 </div>
                                 </div>';         
         }
       /*  else{
             $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
         }*/
     
     }
  return $output;
   }
   public function deleteMessage($sid,$rid,$sms_id)
   {
    $stm = $this->conn->prepare("DELETE from MESSAGES where rid=? and sid=? and sms_id=? or rid=? and sid=? and sms_id=?");
    $stm->bindValue(1, $rid);
    $stm->bindValue(2, $sid);
    $stm->bindValue(3, $sms_id);
    $stm->bindValue(4, $sid);
    $stm->bindValue(5, $rid);
    $stm->bindValue(6, $sms_id);
    $stm->execute();
   }
}
?>