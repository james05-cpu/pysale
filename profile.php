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
    <title>pySale | Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<style>
    body{
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;

    }
.contents{
margin-top:150px;

}
.small-container1{
     width: 100%;
             margin-left: 5px;

display: flex;
align-items: center;
flex-wrap: wrap;
flex-direction: column;
}
.user-p-card{
margin-top:100px;
display: flex;
flex-direction:column;
width: 400px;
float: center;
border-radius: 10px;
}
.user-p-card .name{
font-size:18px;
margin-top:5px;
}
.user-p-card button{
margin-top:5px;
border:none;
outline:0;
display:inline-block;
padding:5px;
text-align:center;
cursor:pointer;
font-size:18px;
}
.user-p-card button:hover{
opacity:0.7;

}
.user-p-card textarea{
margin-top:5px;
margin-right: 15px;
resize:none;
display: inline-block;
height: 100px;
width: 300px;
font-size: 17px;
}
        .delete-btn ,.update-btn{
        margin-top:5px;

        }
        .update-btn{
        background-color: skyblue;
        width: 50px;


        }
.name, .fullname, .loc{
margin-top:5px;
}
input[type="text"], input[type="tel"],input[type="email"]{
    width:340px;
    margin-right: 15px;
    font-size: 17px;

}
input[type="file"]{
    align-items: center;
  width: 340px;
  padding: 5px 20px 0   20px;
  margin: 5px 10px22px 0;
  display: inline-block;
  border: none;
  margin-right: 15px;
  text-align: center;
  background:green;
  border-radius: 10px;

}
  .delete-btn{
        background-color: palevioletred;
}

.p-img{
border-radius:10px;
display: block;

}
.show{
    display: inline-block !important;
}
button{
border-radius:10px;
}
.update {
     width: 100%;
     display:none;
}
.info p{
    display: inline-block;
}
.info img:hover{
    background: whitesmoke;
}
.foot{
    display: flex;
    flex-direction: column;
        background:  #EDF1FF;

}
.info img{
    cursor: pointer;
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
            <li><a href="/profile.php" >Profile</a></li>
            <li><a href="/home.php" >Home</a></li>
            <li><a href="/orders.php" id="orders">Orders</a></li>
                         <li><a href="/followed.php" id="wers">Followers</a></li>
                         <li><a href="/following.php" id="wings">Following</a></li>
            <li><a href="/hist.php">Activity</a></li>
                        <li><a href="/dashboard.php">Dashboard</a></li>
        </div>
    </ul>
</nav>
<div classs="contents">
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
<div class="small-container1">
                <?php
$res=$conn->query("SELECT* FROM USERINFO where `username`='$uid'");
        while( $row=$res->fetchArray()){
        ?>
        <div class="user-p-card">
            <div class="p-img">
                            <img src="<?php echo $row['imgsrc'];?>" style="width: 400px; height: 400px; border-radius:10px;">

            </div>

            <div class="info"> 
           <p><?php echo $row['storename'];?></p>
                <img src="icon_edit.png" id="up-storename" width="20px" height="20px">
           </div>
            

            <div class="update" id="update-name">
            <form action="up_settings.php" method="post">
                                <input type="hidden" name="cate" value="storename">

                <input type="text" name="storename" class="name"  required>
                <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>
            </form>
            </div>
       
           <div class="info"> 
            <p><?php echo $row['fullname'];?></p>
                <img src="icon_edit.png" id="up-fullname" width="20px" height="20px">
           </div>
            <div class="update" id="update-fullname">
    <form action="up_settings.php" method="post">
                <input type="hidden" name="cate" value="fullname">

                <input type="text" name="fullname" class="fullname"  required>
                <button type="submit"  class="update-btn" name="update_store">
                                Save

                </button>
           
        </form>  
         </div>       

<div class="info"> 
            <p>           <?php echo $row['loc'];?></p>
                <img src="icon_edit.png" id="up-loc" width="20px" height="20px">
           </div>



            <div class="update"  id="update-loc">
<form action="up_settings.php" method="post" >

            <p>
                                <input type="hidden" name="cate" value="loc">

                <input type="text" name="loc" class="loc"  required>
                <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>
                </form> 
</div>

<div class="info"> 
            <p><?php echo $row['des'];?></p>
                <img src="icon_edit.png" id="up-des" width="20px" height="20px">
           </div>

                

            <div class="update" id="update-des">
             <form action="up_settings.php" method="post" >
                <input type="hidden" name="cate" value="des">
                <textarea rows="4" cols="30" class="des" name="des"></textarea> 
                <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>
        </form> 
</div>

<div class="info"> 
            <p>Email</p>
                <img src="icon_edit.png" id="up-email" width="20px" height="20px">
           </div>
  <div class="update"  id="update-email">
<form action="up_settings.php" method="post" >

            <p>
                                <input type="hidden" name="cate" value="email">

                <input type="email" name="email" class="email"  required>
                <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>
                </form> 
</div>

<div class="info"> 
            <p>Phone</p>
                <img src="icon_edit.png" id="up-phone" width="20px" height="20px">
           </div>
  <div class="update"  id="update-phone">
<form action="up_settings.php" method="post" >

            <p>
                                <input type="hidden" name="cate" value="phone">
                <input type="tel" name="phone" class="Phone"  required>
                <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>
                </form> 
</div>
<div class="info"> 
            <p>Profile pic</p>
                <img src="icon_edit.png" id="up-image" width="20px" height="20px">
           </div>
            <div class="update" id="update-image">
<form action="up_settings.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="cate" value="image">

<input type="file" name="image" class="file" required>
  <button type="submit" class="update-btn" name="update_store">
                                Save

                </button>         
        </form> 
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

        document.getElementById("up-storename").addEventListener("click", disp)

        function disp() {
          document.getElementById("update-name").classList.add("show");
        }


        document.getElementById("up-fullname").addEventListener("click", disp1)

        function disp1() {
          document.getElementById("update-fullname").classList.add("show");
        }

         document.getElementById("up-des").addEventListener("click", disp2)

        function disp2() {
          document.getElementById("update-des").classList.add("show");
        }
         var element=document.getElementById("up-loc").addEventListener("click", disp3)

        function disp3() {
          document.getElementById("update-loc").classList.add("show");
        }

         var element=document.getElementById("up-phone").addEventListener("click", disp4)

        function disp4() {
          document.getElementById("update-phone").classList.add("show");
        }

         var element=document.getElementById("up-email").addEventListener("click", disp5)

        function disp5() {
          document.getElementById("update-email").classList.add("show");
        }

         var element=document.getElementById("up-image").addEventListener("click", disp6)

        function disp6() {
          document.getElementById("update-image").classList.add("show");
        }
</script>
<script src="./profileloader.js"></script>
</body>
</html>
