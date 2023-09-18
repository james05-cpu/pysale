<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
?>
<?php
$wers = $conn->query("SELECT COUNT(*) as count FROM FOLLOWERS where followed_id= '$uid'");
$itwers = $wers->fetchArray();
$werscount = $itwers['count'];
$wings = $conn->query("SELECT COUNT(*) as count FROM FOLLOWERS where follower_id= '$uid'");
$itwings = $wings->fetchArray();
$wingscount = $itwings['count'];

$sold = $conn->query("SELECT COUNT(*) as count FROM ORDERS where sid= '$uid'");
$sales=$sold->fetchArray();
$scount=$sales['count'];
$bal="";
$res=$conn->query("SELECT* FROM WALLET where `wid`='$uid'");
        while( $row=$res->fetchArray()){
$bal=$row['bal'];
          }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>pySale | DashBoard</title>
    <link rel="stylesheet" href="dashboard.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7005222992541258"
     crossorigin="anonymous"></script>
     <style type="text/css">
       .info{
        display: flex;
        align-items: center;
        flex-direction: row;
        height: 40px;
        gap: 20px;
       }
       .ico img{
        height: 100%;
        width: 100%;
       }
       .more img{
        height: 12px;
        width: 12px;
       }
       .foot{
        margin-top: 20px;
        display: flex;
        align-items: flex-end;
        float: right;
       }
       .more{
        align-items: center;
        gap: 2px;
        width:56px;
        height: 25px;
        display:flex;
        flex-direction: row;
       }
       .ico{
        margin-bottom: 20px;
        width: 60px;
        height: 50px;
       }
       .cascade{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
       }
       .delete{
        height: 25px;
        width: 20px;

       }
       .delete img{
        width: 100%;
        height: 100%;
       }
       a{
        color:mediumseagreen;
        text-decoration: none;
       }
     box{
      padding-right: 5px;
     }
   .box{
      color:  #0A2558;
     }
     .box:hover{
      background: #0A2558;
      color: white;

     }
     .top-sales:hover{
      color: black;
     }

     </style>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">pySale</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="home.php">
<i class="fa fa-home" aria-hidden="true"></i>
            <span class="links_name">Home</span>
          </a>
        </li>
        <li>
          <a href="products.php">
<i class="fa fa-product-hunt" aria-hidden="true"></i>
            <span class="links_name">Products</span>
          </a>
        </li>
        <li>
          <a href="orders.php">
<i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span class="links_name">Orders</span>
          </a>
        </li>
        <li>
          <a href="upload.php">
<i class="fa fa-cloud-upload" aria-hidden="true"></i>
            <span class="links_name">Upload</span>
          </a>
        </li>
       
        <li>
          <a href="following.php">
<i class="fa fa-users" aria-hidden="true"></i>
            <span class="links_name">Following</span>
          </a>
        </li>
       <!-- <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>-->
        <li>
          <a href="followed.php">
            <i class='bx bx-heart' ></i>
            <span class="links_name">Followers</span>
          </a>
        </li>
       
           <li>
          <a href="hist.php">
<i class="fa fa-history" aria-hidden="true"></i>
            <span class="links_name">Activity</span>
          </a>
        </li>
        <li>
          <a href="configuration.php">
<i class="fa fa-user" aria-hidden="true"></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        
        <li class="log_out">
          <a href="logout.php">
<i class="fa fa-sign-out" aria-hidden="true"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search..." id="tag">
        <i class='bx bx-search' id="search" ></i>
      </div>

<?php

$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
  $image=$row['imgsrc'];
  $fullname=$row['fullname'];

}
?>

      <div class="profile-details">
        <img src="<?php echo $image; ?>" alt="">
        <span class="admin_name"><?php echo $fullname; ?></span>
        <i class='bx bx-chevron-down' ></i>
      </div>



    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box cascade">
           <div class="ico">
              <img src="icon_sales.png">
            </div>
          <div class="right-side">
           
            <div class="box-topic">
            <span style="opacity:0.7;">You have <?php echo $scount; ?> Sales</span>
         
          </div>
          <div class="foot">
          <div class="more">
            <span><a href="orders.php" style="color: #0074D9;" >more</a></span>
            <img src="icon_right_arrow_1.png">
          </div>
          </div>
        </div>
      </div>
        <div class="box cascade">
          <div class="ico">
              <img src="icon_money_bag_won.png">
            </div>
          <div class="right-side">
            <div class="box-topic">
            <span style="opacity:0.7;">You have <?php echo $bal; ?> Bonus</span>
              </div>
              <div class="foot">
          <div class="more">
            <span><a href="dashboard.php" style="color: #0074D9;">more</a></span>
            <img src="icon_right_arrow_1.png">
          </div>
          </div>
          </div>
        </div>
        <div class="box cascade">
          <div class="ico">
              <img src="icon_children.png">
            </div>
          <div class="right-side">
            <div class="box-topic">
            <span style="opacity:0.7;"><?php echo $wingscount; ?> Followed</span>
           </div>
           <div class="foot">
          <div class="more">
            <span><a href="following.php" style="color: #0074D9;">more</a></span>
            <img src="icon_right_arrow_1.png">
          </div>
          </div>
          </div>
        </div>
        <div class="box cascade">
           <div class="ico">
              <img src="icon_children.png">
            </div>
          <div class="right-side">
            <div class="box-topic">
            <span style="opacity:0.7;" >Followed by <?php echo $werscount; ?></span>
          </div>
            <div class="foot">
          <div class="more">
            <span><a href="followed.php" style="color: #0074D9;" >more</a></span>
            <img src="icon_right_arrow_1.png">
          </div>
          </div>
          </div>
        </div>
      </div>

     <div class="sales-boxes">
        <div class="top-sales box">
          <div class="title info">
            <div class="ico">
              <img src="icon_sms.png">
            </div>
           <div class="txt">
             <span style="opacity: 0.7;">Messages</span>
           </div>
          </div>
          <ul class="top-sales-details">
  

<?php

$in=array();
$res1=$conn->query("SELECT* FROM CHATS where rid='$uid' " );
while( $row=$res1->fetchArray()){
array_push($in,$row['sid']);
}
foreach($in as $nm){
$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$nm);
$res=$stm->execute();
while( $row=$res->fetchArray()){
?>
  <li class="sms">
    <input type="hidden" class="cid" name="cid" value="<?php echo $row['username']; ?>">
             <a href="<?php echo "shop_gateway.php?sid=".$row['username']; ?>">

              <img src="<?php echo $row['imgsrc']; ?>" alt="">
              <span class="product"><?php echo $row['fullname']; ?></span>
            </a>
            <span class="delete">
              <img class="deleteico" src="icon_delete.png">
            </span>
          </li>

          <?php
        }
      }
?>



          <?php
          $out=array();
$res=$conn->query("SELECT* FROM CHATS where sid='$uid' " );
while( $row=$res->fetchArray()){
  if (!in_array($row['rid'], $in)) {
array_push($out,$row['rid']);
  }

}
foreach($out as $nm){
$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$nm);
$res=$stm->execute();
while( $row=$res->fetchArray()){

  ?>
<li class="sms">
    <input type="hidden" class="cid" name="cid" value="<?php echo $row['username']; ?>">
            <a href="<?php echo "shop_gateway.php?sid=".$row['username']; ?>">
              <img src="<?php echo $row['imgsrc']; ?>" alt="">
              <span class="product"><?php echo $row['fullname']; ?></span>
            </a>
             <span class="delete">
              <img class="deleteico" src="icon_delete.png">
            </span>
          </li>

          <?php
        }
      }
?>


          </ul>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.getElementById('search').addEventListener('click',sh)
    function sh(event){
      var tag=document.getElementById('tag').value;
      var url="search.php?tag="+tag;
      window.location=url;
    }
    
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>
 <script type="text/javascript" src="./dash.js"></script>

</body>
</html>
