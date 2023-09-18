<?php
include('conn.php');
session_start();
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

    <title>pySale | Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin:0;
            background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
        }
.content{
margin-top:100px;
margin-left: 5px;
}
    .user-row{
margin-top:20px;
display: flex;
align-items: center;
flex-wrap: wrap;
gap: 20px;
flex-direction:row;
width: 100%;
}
.user-p-card{

width:270px;
margin-bottom:20px;
cursor: pointer;
display: flex;
gap: 10px;
flex-direction: column;
border:lightgray 1px solid;
border-radius: 5px;
    padding: 10px;

}
.user-p-card .price{
font-size:18px;
}
.user-p-card button{
 cursor: pointer;
    height: 40px;
    border-radius: 30px;
    width: 230px;
    background: royalblue;
    text-align: center;
    color: white;
    align-content: center;
    border: none;
    font-size: 16px;
    margin-bottom: 10px;

}
 button:hover{
opacity:0.7;
}
.price{
width:205px;

}
h3{
    opacity: 0.8;
    font-weight: 400;
}

.userimage{
   max-width: 250px;
    height: 300px;
}
img{
    width: 100%;
    height: 100%;
}
.productname{
    margin-top: 15px;
}
p{
        display: block;
        width: 100%;
    }
@media only screen and (max-width: 480px) {
    .user-p-card{
        width: 100%;
        margin-right: 5px;
    }
    .user-p-card button{
        width: 100%;
        float: left;
    }
    
    .userimage{
    max-width: 100%;
    max-height: 350px;
}
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
                        <li><a href="/trending.php">Trending</a></li>
                        <li><a href="/dashboard.php">Dashboard</a></li>
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
<div class="small-container">
    <div class="user-row">


                <?php
$c=0;
$res=$conn->query("SELECT* FROM PRODUCTS where `username`='$uid'");
        while( $row=$res->fetchArray()){
$c=$c+1;
        ?>
        <div class="user-p-card">
       <div class="userimage">
           <img src="<?php echo $row['imgsrc'];?>">
       </div>
                   <h3 name="productname" class="productname" ><?php echo $row['productname'];?></h3>
            <p class="priceEl"><?php echo $row['price'];?> ksh</p>
            <p><?php echo $row['des'];?> </p>
            <!--<form action="store.php" method="get">-->
            <!--<input type="hidden" value="<?php echo $row['pid'];?>" class="username" name="pid" >
            <p><button type="button" class="update-btn">Update</button></p>

            -->
           <p> <button type="button" class="delete-btn">Delete</button></p>

        </div>
        <?php
}
if($c==0){
echo("<h3>Products will appear here</h3>");
}
?>

    </div>
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
                <p class="des" id="fullname">des</p>
                <p class="loc" id="loc">loc</p>
                <p class="edit">edit</p>
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

    <!-- Footer End -->

<script type="text/javascript">
     var fl=<?php echo json_encode(strtolower($fullname)); ?>;
          var loc=<?php echo json_encode(strtolower($loc)); ?>;
          var des=<?php echo json_encode(strtolower($des)); ?>;

         document.getElementById("fullname").innerText=fl;
          document.getElementById("loc").innerText=loc;
          document.getElementById("des").innerText=des;

</script>
<script src="./profileloader.js"></script>
<script src="./render/users.js"></script>

</script>
</body>
</html>
