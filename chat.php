<?php 
  session_start();
  include_once "conn.php";
  include('existinguser.php');
  if(!isset($_SESSION['username'])){
    header("location: index.php");
  }
   $user_id = $_SESSION['username'];
          $rec_id = $_SESSION['sid'];
         if($rec_id==null){
          header("Location:recError.php");
        exit;
      }
      $receiver=new ExistingUser($rec_id);
      $rec_info=$receiver->getUserInfo($rec_id);
      $rimage=$rec_info['imgsrc'];
      $rname=$rec_info['fullname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>pySale | Chat</title>
  <link rel="stylesheet" href="sms.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
  <div class="info">
  <a href="#" class="back-icon" onclick="goBack()" ><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $rimage; ?>" alt="">
        <div class="details">
          <span><?php echo $rname; ?></span>
      <!--    <p>status</p>-->
        </div>

  </div>
  
        <div class="tool-bar" id="tools">
         <div class="delete  tool" >
          <img src="icon-delete.png" id="delete" title="delete">
         </div>
         <div class="select-all tool">
          <img src="icon_select_all.png" id="select-all" title="select all">
         </div>
         <div class="unselect-all tool">
          <img src="icon_unselect_all.png" id="unselect-all" title="unselect all">
         </div>
         <div class="edit-sms tool">
          <img src="icon_edit_sms.png" id="edit-sms" title="edit-sms">
         </div>
        </div>
      </header>
      <div class="chat-box" id="box">

      </div>
      <form class="typing-area">
       <!-- <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>-->
        <input type="text" name="message" class="input-field" placeholder="Type message here..." autocomplete="off">
        <button type="submit" ><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
<script>
function goBack() {
  window.history.back()
}

function select(id){
  var text=document.getElementById(id);
  document.getElementById('box').classList.add('selectMode')
  var details=text.getElementsByTagName('p')[0]
  if(text.classList.contains("selected")){
    text.classList.remove('selected')
    details.style.backgroundColor="whitesmoke"
    details.style.color="#333"
  }
  else{ 
  text.classList.add('marked')
  details.style.backgroundColor="gray"
  details.style.color="white"
  text.classList.add('selected')
  var details=text.getElementsByTagName('p')[0].innerHTML;
  console.log(details)
  }
}
  

</script>

  <script src="chat.js"></script>

</body>
</html>
