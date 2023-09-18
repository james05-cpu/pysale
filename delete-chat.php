<?php
include('chatsystem.php');
session_start();
$ids =SQLite3::escapeString($_POST['id']);
$sid = $_SESSION['username'];
$rid = $_SESSION['sid'];
$system=new ChatSystem();
if($system->isValidDEL($sid,$rid,$ids)){
    $idList=explode(",",$ids);
    foreach($idList as $id){
        $system->deleteMessage($sid,$rid,$id);
    }
}
?>