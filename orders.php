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

    <title>pySale | Orders</title>
    <link rel="stylesheet" href="style.css">
<style>
body{
padding:0;
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}
tr{
    font-size: 16px;
}
.content{
margin-top:100px;
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
border: 1px solid #ccc;
resize: none;
}
.container1 {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
 max-width: 800px;
 margin: 10px auto;
  padding: 20px 20px;

}

.darker {
  border-color: #ccc;
  background-color: #fff;
}

.container1::after {
  content: "";
  clear: both;
  display: table;
}
.time-right {
  float: right;
  color: #aaa;
}
.link{
margin-right:5px;
margin-left:5px;
color:blue;
}
.link a:hover{
opacity:0.6;
}
.container1 button{
  max-width: 100px;
  margin-right: 15px;
  border: none;
  cursor: pointer;
  font-weight: 500;
padding-bottom: 5px;
padding-right: 5px;
padding-left: 5px;
border-radius: 2px;
}
.accept{
  color: darkblue;
}
.decline{
  color: crimson;
}
.status{
  color: green;
}
.cancel{
  color: crimson;
}
.cancel:hover{
  opacity: 0.6;
}
.accept:hover{
  opacity: 0.6;
}
.decline:hover{
  opacity: 0.6;
}
td{
    margin-right: 20px;
}
@media (max-width: 830px) {
.container1{
margin: 10px 20px;
}
.container1 button{
margin-bottom: 5px;
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
                        <li><a href="/dashboard.php">Dashboard</a></li>
        </div>
    </ul>
</nav>
<!--<h2>Chat Messages</h2>-->
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
<div class="content">
<?php
//$res=$conn->query("SELECT* FROM ORDERS where `seller`=? or `buyer`=?");
$c=0;
$stm=$conn->prepare("SELECT* FROM ORDERS where `sid`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$c=$c+1;
?>
<div class="container1 darker">
  <p class="right">CONFIRMED  <span class="link" style="cursor: pointer;"><?php echo $row['buyer'];?></span> ORDERED:</p>
  <p>
<table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Quad</th>

</tr>
  <?php echo $row['orderinfo'];?>
</table></p>
  <p><?php echo $row['message'];?></p>
<span class="time-right"><?php echo $row['time'];?></span>
<input type="hidden" class="oid" name="oid" value="<?php echo $row['oid'];?>">
<input type="hidden" name="bid" class=" bid" value="<?php echo $row['bid'];?>">
<button class="accept"> Accept</button>
<button class="decline" > Decline</button>
<button class="status" disabled><?php echo $row['status'];?></button>
</div>

<?php
}

?>

<?php
//$res=$conn->query("SELECT* FROM ORDERS where `seller`=? or `buyer`=? order by id desc");

$stm=$conn->prepare("SELECT* FROM ORDERS where `bid`=? order by id desc");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$c=$c+1;
?>
<div class="container1 darker">

  <p class="right">CONFIRMED YOU ORDERED:</p>
  <p><table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Quad</th>

</tr>
<?php echo $row['orderinfo'];?>
</table></p>
  <p><?php echo $row['message'];?></p>
  <span class="time-right"><?php echo $row['time'];?></span>
<input type="hidden" name="oid" class="oid" value="<?php echo $row['oid'];?>">

<button class="cancel"> Cancel</button>
<button class="status" disabled><?php echo $row['status'];?></button>

</div>

<?php
}
if($c==0){
echo("<h3>Orders will appear here</h3>");
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
                        <h5 class="font-weight-bold link mb-4">Text Customers</h5>
                        <form action="text-customers.php" method="post">
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
<script>
var spans = document.getElementsByClassName('link')
    for (var i = 0; i < spans.length; i++) {
        var span = spans[i]
       span.addEventListener('click', view)
    }  

function view(event){
 var clicked = event.target
    var obj = clicked.parentElement.parentElement;
console.log(obj)
var bidEl = obj.getElementsByClassName('bid')[0];
var bid=bidEl.value;
const url="store.php?username="+bid;
window.location=url;
}
</script>
<script src="./odmg.js"></script>
</body>
</html>


