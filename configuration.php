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

    <title>pySale | Config</title>
    
    <style type="text/css">
        .settings{
display: flex;
justify-content: space-between;
flex-wrap: wrap;
        }
        .common{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
.sub{
    padding: 30px 0 50px 0;
}
        .sub button{
        background: blue;
        width: 150px;
        padding: 5px 20px;
        color: white;
        border-radius: 5px;
        border: none;
        }

        a{
  text-decoration: none;
  color: #0074D9;
}

.connect{
  position: relative;
  font-size: 17px;
}

.connect::before{
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  width: 0;
  height: 2px;
  background-color: #0074D9;
  transition: width 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}
@media (hover: hover) and (pointer: fine) {
  .connect:hover::before{
    left: 0;
    right: auto;
    width: 100%;
  }
}

.pass, .edit{
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 1px;
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
}
.link {
  color: #1C1C1C !important;
      margin-top: 10px;

}
.titlef{
    display: flex;
    flex-direction: column;
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
.links a{
    text-decoration: none;
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


<div class="choice">
<div class="head">
<h1>Configure Your Interest</h1>
<div class="settings">
    <div class="common">
    <form action="configpool.php" method="post">
        
        <div class="broadcast">
           <input type="checkbox" name="b1"><span>Allow brodcast messages from Your Supplier</span>
        </div>
        <div class="broadcast">
           <input type="checkbox" name="b2"><span>Allow brodcast messages from people you follow</span>
        </div>
        <div class="broadcast">
           <input type="checkbox" name="b3"><span>Allow brodcast messages from followers</span>
        </div>
        <div class="broadcast">
           <input type="checkbox" name="b3" disabled><span>Notify customers on addition of new product in my shop</span>
        </div>
        <div class="broadcast">
           <input type="checkbox" name="b4" disabled><span>Notify customers on deletion of product in my shop</span>
        </div>
             <div class="broadcast">
           <input type="checkbox" name="b5" disabled><span>Notify customers when I change location</span>
        </div>
        <div class="sub">
            <button type="submit">Submit</button>
        </div>
    </form>
    </div>
    <div class="others">
    <div class="pass"> 
<a href="reset.php" class="connect">Reset PassWord</a>
<img src="icon_right_arrow_1.png" style="width:20px; height: 20px;">
    </div>
<div class="edit">
    <a href="profile.php" class="connect">Edit Profile</a>
    <img src="icon_right_arrow_1.png" style="width:20px; height: 20px;">

</div>
</div>
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
                <p class="des" id="fullname"></i>des</p>
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
                            <a class="link" href="contact.php">Contact Us</a>
                        </div>
                    </div>
                        <div class="colfc">
                        <h5 class="mb-4">Service</h5>
                        <div class="links">
                            <a class="link" href="trending.php">Trending</a>
                            <a class="link " href="push-ad.html">Create Ad</a>
                             <a class="link " href="hist.php"></i>Activity</a>
                            <a class="link" href="policy.html">Policy</a>
                           
                        </div>
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
   
</script>
</body>
</html>
