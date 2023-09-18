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

    <title>pySale | Home</title>
    <link rel="stylesheet" href="style.css">
    
    <style type="text/css">
        *{
            margin:0;
        }
          body{
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}
        .small-container-home{
            margin-top: 100px;
        }
      .profile row  .small-container-home:focus{
            outline: none;
        }
        .profile-card{
width:270px;
margin-bottom:20px;
padding: 20px 5px;
display: flex;
flex-direction: column;
border:lightgray 1px solid;
border-radius: 5px;
border-right: 10px;

}
.profile-card:hover{
    outline: none;
}
img, button, h1,p:focus{
    outline: none;
}
.profile-card img{
border-radius: 10px;
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
h3{
    opacity: 0.8;
    margin-bottom: 15px;
}
p{
    margin-bottom: 15px;
}
img{
    width: 100%;
    height: 100%;
}
.view{
    cursor: pointer;
    height: 40px;
    border-radius: 30px;
    width: 250px;
    background: royalblue;
    text-align: center;
    color: white;
    align-content: center;
    border: none;
    font-size: 16px;
}
.userimage{
    max-width: 250px;
    max-height: 250px;
}
@media only screen and (max-width: 480px) {
    .profile-card{
        width: 100%;
    }
    .view{
        width: 100%;
        float: left;
    }
    .userimage{
    max-width: 350px;
    max-height: 350px;
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
            <li><a href="/home.php" >Home</a></li>
            <li><a href="/products.php" id="product">Products</a></li>
            <li><a href="/upload.php">New Product</a></li>
             <li><a href="/push-ad.php">Create Ads</a></li>
<li><a href="/my-ads.php">My Ads</a></li>

            <li><a href="/trending.php">Trending</a></li>
                        <li><a href="/dashboard.php">Dashboard</a></li>
        </div>
    </ul>
</nav>

<div class="small-container-home">
<div class="searchbox">  
<form action="search.php" method="get">   
<input type="text" placeholder=" seller/shop name/town/product..." name="tag">   
<button type="submit">Search</button>   
</form>  
</div>   
    <div class="profile-row">
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
$res=$conn->query("SELECT* FROM USERINFO");
while( $row=$res->fetchArray()){
?>
 <div class="profile-card">
    <div class="userimage">
           <img src="<?php echo $row['imgsrc'];?>">
       </div>
       <div>
           <h3><?php echo $row['fullname'];?></h3>
           <p class="name"><?php echo $row['storename'];?></p>
         <p><?php echo $row['des'];?></p>
<!--<form action="store.php" method="get">-->
<input type="hidden" value="<?php echo $row['username'];?>" class="username" name="username" >
               <p><button type="button" class="view" style="background: royalblue;">Shop Now</button></p>
</div>
       </div>
<?php
}
?>

    </div>
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
                        <h5 class="mb-4">Newsletter</h5>
                        <form action="subscribe.php" method="post">
                            <div class="form-group">
                                <input type="text" id="nm" name="name" class="form-control" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" id="em" name="email" class="form-control" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Subscribe Now</button>
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
    /**document.getElementById("submit").addEventListener('click', sub);
    function sub() {
        var name=document.getElementById("nm").value;
        var email=document.getElementById("em").value;
var url="subscribe.php?nm="+name+"&em="+email;
 let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){

          }
      }
    }
  xhr.send(formData);
    }**/
   
</script>
<script src="./render/profileloader.js"></script>

</script>
</body>
</html>
