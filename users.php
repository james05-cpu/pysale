<?php 
  session_start();
  include('conn.php');
  if(!isset($_SESSION['username'])){
    header("location: index.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
$uid=$_SESSION['username'];
            $stm=$conn->prepare("SELECT* FROM CHATS where `sid`=? or `rid`=?");
$stm->bindValue(1,$uid);
$stm->bindValue(2,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){

          ?>
          <img src="<?php echo $row['rimage']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['rname'] ?></span>
          
          </div>
  <p>Active</p>
<?php
}
?>
        </div>

       
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

