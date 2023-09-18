<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid==null){
header("Location:index.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pySale | My-ads</title>
    <link rel="stylesheet" href="style.css">

<style>
    body{
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}
.content{
margin-top:100px;
}
    .small-container{
      display:flex;
flex-direction:row;
align-content: space-around;
gap: 30px;
margin-left: 25px;
margin-right: 25px;
    }


.small-img-row{
       max-width: 270px;
    display: flex;
    align-content: center;
    justify-content: center;
    gap: 30px;
}
.small-img-col{
    border-radius: 10px;
    width: 100px;
    height: 100px;
    cursor: pointer;
    border: 1px solid transparent;
    margin-top: 15px;
}
.small-img-col img{
    width: 100%;
    height:100%;
    border-radius: 10px;
    cursor: pointer;

}
#product-img{
    border-radius: 5px;
    width: 100%;
    height: 100%;
}
.product-image{
    margin-top: 10px;
    height: 350px;
    width: 350px;
}
h1{
    opacity: 0.7;
}
h3{
    opacity: 0.7;
    margin-bottom: 15px;
}
span{
    opacity: 0.8;
    font-weight: 500;
    font-size: 16px;
}
.foot{
    display: flex;
    flex-direction: column;
        background:  #EDF1FF;

}
.containerf{
    display: flex;
    justify-content: space-between;
    padding-top: 60px;
    flex-wrap: wrap;
     margin-right: 5px;
    margin-left: 5px;
}
.link {
  color: #1C1C1C !important;
      margin-top: 10px;

}
.titlef{
    display: flex;
    flex-direction: column;
        max-width: 250px;

}
.colfb{
      display: flex;
    flex-direction: column;
}
.colfc{
      display: flex;
    flex-direction: column;
}
.links{
      display: flex;
    flex-direction: column;
    font-size: 18px;
}
.links a:hover{
text-decoration: underline;
}
.mb-4{
    font-size: 24px !important;
}

.reached{
        margin-top: 20px;
}
@media only screen and (max-width: 580px){
    .small-container{
        flex-direction: column;
        margin: 0;
    }
   .col-2{
    margin:0;
    }
    .single-product h1{
        font-size: 26px;
        line-height: 32px;
    }
}
</style>
</head>
<body>
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo">pySale</div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
        <!-- USING CHECKBOX HACK -->
        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
        <!-- NAVIGATION MENUS -->
         <div class="menu">
            <li><a href="/profile.php" >Profile</a></li>
            <li><a href="/home.php" >Home</a></li>
            <li><a href="/orders.php" id="orders">Orders</a></li>
                         <li><a href="/followed.php" id="wers">Followers</a></li>
                         <li><a href="/following.php" id="wings">Following</a></li>
            <li><a href="/hist.php">Activity</a></li>
                         

        </div>
    </ul>
</nav>
<div class="content">
<?php
$stm=$conn->prepare("SELECT* FROM USERINFO where `username`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
$loc="";
$des="";
$fullname="";
while( $row=$res->fetchArray()){
$loc=$loc.$row['loc'];
$des=$des.$row['des'];
$fullname=$fullname.$row['fullname'];
}
?>
  <?php
  
 
$adid="";
$c=0;
$res=$conn->query("SELECT* FROM ADS where `username`='$uid'");
        while( $row=$res->fetchArray()){
$adid=$row['aid'];
$c=$c+1;
        ?>
        <div class="small-container">
    <div class="col-2">
        <div class="product-image">
<img src="<?php echo $row['front']; ?>" id="product-img">
</div>
<div class="small-img-row">
    
  <div class="small-img-col">
<img src="<?php echo $row['side']; ?>" width="270px" class="small-img">
    </div>
      <div class="small-img-col">
<img src="<?php echo $row['top']; ?>" width="270px" class="small-img">
    </div>
<div class="small-img-col">
<img src="<?php echo $row['front']; ?>" width="270px" class="small-img">
    </div>
</div>

    </div>
    <div class="col-2">
<h1><?php echo $row['category']; ?></h1>
<h3><?php echo $row['name']; ?></h3>
<h4 style="margin-top: 15px; margin-bottom: 15px;">500.00</h4>
<h3>Description</h3>
<p><?php echo $row['des']; ?></p>
<div class="reached"><span id="reached">0 reached</span></div>
<div><span id="clicked"></span></div>

</div>
</div>


        <?php
}
if($c==0){
echo("<marquee direction='right' width='60%'><h1>You have no active ads with us</h1></marquee>");
}

?>
<?php
$reached= $conn->query("SELECT COUNT(*) as count FROM REFS where aid= '$adid'");
$reach = $reached->fetchArray();
$reachedcount = $reach['count']." People Reached";
$clickscount="0";
  $clickers= $conn->query("SELECT COUNT(*) as count FROM AD_CLICKS where aid= '$adid'");
$clicks = $clickers->fetchArray();
$clickscount = $clicks['count']." People Clicked";

?>
</div>
      
     <!-- Footer Start -->
    <div class="foot">
    <div class="containerf">
        <div class="titlef">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopp</h1>
                </a>
                <p id="des">name</p>
                <p class="des" id="fullname"><i class="fa fa-map-marker-alt text-primary mr-3"></i>des</p>
                <p class="loc" id="loc"><i class="fa fa-envelope text-primary mr-3"></i>loc</p>
                <p class="edit"><i class="fa fa-phone-alt text-primary mr-3"></i>edit</p>
            </div>




            <div class="colfb">
               
                         <h5 class="mb-4">Quick Links</h5>
                        <div class="links">
                            <a class="link" href="home.php">Home</a>
                            <a class="link" href="dashboard.php">Dashboard</a>
                            <a class="link" href="orders.php">Orders</a>
                            <a class="link" href="products.php">Products</a>
                            <a class="link" href="upload.php">Upload</a>
                            <a class="link" href="contact.php"></i>Contact Us</a>
                        </div>
                    </div>
                        <div class="colfc">
                        <h5 class="mb-4">Service</h5>
                        <div class="links">
                            <a class="link" href="trending.php">Trending</a>
                            <a class="link " href="push-ad.php">Create Ad</a>
                             <a class="link " href="hist.php">Activity</a>
                            <a class="link" href="policy.html">Policy</a>
                           
                        </div>
                    </div>
                    <div class="colfd">
                        <h5 class="font-weight-bold link mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                
        
    </div>

    <div class="colfd">
            <div class="site">
                <p class=" link">
                    &copy; <a class="reachout" href="#">pySale</a>. All Rights Reserved.
                    <a class="" href="#">TiDe</a>
                </p>
            </div>
            <div class="valued">
            </div>
        </div>
        </div>
    <!-- Footer End -->


<script type="text/javascript">
     var fl=<?php echo json_encode(strtolower($fullname)); ?>;
          var loc=<?php echo json_encode(strtolower($loc)); ?>;
          var des=<?php echo json_encode(strtolower($des)); ?>;

         document.getElementById("fullname").innerText=fl;
          document.getElementById("loc").innerText=loc;
          document.getElementById("des").innerText=des;

</script>

        <script type="text/javascript">
            var rc=<?php echo json_encode($reachedcount); ?>;
          var cc=<?php echo json_encode($clickscount); ?>;

         document.getElementById("reached").innerText=rc;
          document.getElementById("clicked").innerText=cc;

            var productimg=document.getElementById("product-img");
            var smallimg=document.getElementsByClassName("small-img");
            smallimg[0].onclick=function () {
                productimg.src=smallimg[0].src;
            }
 smallimg[1].onclick=function () {
                productimg.src=smallimg[1].src;
            }

             smallimg[2].onclick=function () {
                productimg.src=smallimg[2].src;
            }
             
        </script>
<script src="./profileloader.js"></script>
</body>
</html>
