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
<html>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>pySale | Following</title>
    <link rel="stylesheet" href="style.css">

    <!-- Customized Bootstrap Stylesheet -->
<style>
    body{
padding:0;
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
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
.message{
width: 100%;
height:90px;
margin:10px 0;
padding: 0 10px;
border: 1px solid lightgrey;
resize: none;
}

.comp {
  margin-top:100px;
  padding: 0 20px;
  display: flex;
  flex-direction: row;
  gap:30px;
  flex-wrap: wrap;
}

.container1 {
  border-radius: 5px;
  padding: 10px;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  border: 1px solid lightgray;
  width: 250px;
  align-items: center;
}


.image{
      max-height: 180px;
  margin-bottom: 10px;
  max-width: 220px;
}
.container1 img {
 height: 100%;
  width: 100%;
  border-radius: 20%;
}

.view{
margin: 20px 0;
color:white;
cursor:pointer;
background: royalblue;
border-radius: 40px;
padding: 10px 20px;
text-align: center;
width: 100%;
font-size: 18px;
}
span:hover{
opacity:0.6;
}
.unfollow {
color:white;
cursor:pointer;
background: skyblue;
border-radius: 20px;
padding: 5px 20px;
text-align: center;
font-size: 18px;
}
.count{
color:red;
}
@media only screen and (max-width: 480px){
    .container1{
        width: 100%;
    }
   .image{
      max-height: 300px;
  margin-bottom: 10px;
  max-width: 300px;
}
.comp {
  padding: 0 5px;
  
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
            <li><a href="/orders.php" id="orders">Orders</a></li>
                         <li><a href="/followed.php" id="wers">Followers</a></li>
                         <li><a href="/following.php" id="wings">Following</a></li>
            <li><a href="/hist.php">Activity</a></li>
                        <li><a href="/dashboard.php">Dashboard</a></li>
        </div>
    </ul>
</nav>
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
<div class="comp">
<?php
$c=0;
$stm=$conn->prepare("SELECT* FROM FOLLOWERS where `follower_id`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$c=$c+1;
?>
<div class="container1">
    <div class="image">
  <img src="<?php echo $row['followed_image'];?>" alt="Avatar" style="width:100%;">
  </div>
<input type="hidden" class="fid" name="fid" value="<?php echo $row['followed_id'];?>">
  <p><?php echo $row['followed_name'];?></p>
  <br>
    <span class="unfollow">Unfollow</span>
  <span class="view">Shop Now</span>
</div>

<?php
}
if($c==0){
echo("<h3>People you follow will appear here</h3>");
}
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
                        <h5 class="font-weight-bold link mb-4">Text Followers</h5>
                        <form action="text-following.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" name="sub" placeholder="subject" required="required" />
                            </div>
                            <div class="form-group">
                                <textarea class="message" rows="5" cols="20" name="message" placeholder="message here"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Send</button>
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
<script src="./render/viewf.js"></script>
</body>
</html>

