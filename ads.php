<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
<style>
.content{
margin-top:100px;
}
    .small-container{
      display:flex;
flex-direction:row;
margin: auto;
padding-left: 25px;
padding-right: 25px;
    }
.single-product{

    margin-top: 80px;
}
.single-product .col-2 img{
    padding: 0;
}
.single-product .col-2{
    padding: 20px;
}
.single-product h4{
    margin: 20px 0;
    font-size: 22px;
    font-weight: bold;

}
.single-product input{
    width: 50px;
    height: 40px;
    padding-left: 10px;
    font-size: 20px;
    margin-right: 10px;
    border: 1px solid #ff523b;
}
input:focus{
    outline: none;
}
.small-img-row{
    display: flex;
    justify-content: space-between;
}
small-img-col{
    flex-basis: 24%;
    cursor: pointer;
}
@media only screen and (max-width: 600px){
    .small-container{
        flex-direction: column;
    }
    .col-2{
        flex-basis: 100%;
    }
    .single-product .col-2{
    padding: 20px 0;
    }
    .single-product h1{
        font-size: 26px;
        line-height: 32px;
    }
}
</style>
</head>
<body>
<?php
$wers = $conn->query("SELECT COUNT(*) as count FROM FOLLOWERS where followed_id= '$uid'");
$itwers = $wers->fetchArray();
$werscount = $itwers['count'];
$wings = $conn->query("SELECT COUNT(*) as count FROM FOLLOWERS where follower_id= '$uid'");
$itwings = $wings->fetchArray();
$wingscount = $itwings['count'];
?>
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
                        <li><a href="/logout.php">Logout</a></li>
        </div>
    </ul>
</nav>
<div class="content">

  <?php
$res=$conn->query("SELECT* FROM ADS where `username`='$uid'");
        while( $row=$res->fetchArray()){
        ?>
        <div class="small-container single-product">
    <div class="col-2">
<img src="<?php echo $row['front']; ?>" width="270px" id="product-img">

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
<p><div class="small-img-col">
<img src="<?php echo $row['category']; ?>" width="270px" class="small-img">
    </div></p>
<h1><div class="small-img-col">
<img src="<?php echo $row['name']; ?>" width="270px" class="small-img">
    </div></h1>
<h4>500.00</h4>
<input type="number" name="" value="1">
<button class="btn">Buy Now</button>
<h3>Description</h3>
<p><div class="small-img-col">
<img src="<?php echo $row['des']; ?>" width="270px" class="small-img">
    </div>
</p>
    </div>
  
</div>


        <?php
}
?>

       </div>
        <script type="text/javascript">
            var productimg=document.getElementById("produt-img");
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
<script>
document.getElementById("wers").innerText+=" "+<?php echo json_encode($werscount);?>;
document.getElementById("wings").innerText+=" "+<?php echo json_encode($wingscount);?>;
</script>
<script src="./profileloader.js"></script>
</body>
</html>
