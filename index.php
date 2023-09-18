<?php
include('conn.php');
$ip=$_SERVER['REMOTE_ADDR'];
$location=unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
$continent=$location[ 'geoplugin_continentName'];
$country=$location['geoplugin_countryName'];
$lat=$location['geoplugin_latitude'];
$log=$location['geoplugin_longitude'];
$radius=$location['geoplugin_locationAccuracyRadius'];
$currencycode=$location['geoplugin_currencyCode'];
$converter=$location['geoplugin_currencyConverter'];
$currencysyombol=$location['geoplugin_currencySymbol'];
$stm=$conn->prepare("INSERT INTO `LOCATION` (ip,continent,country,latitude,logitude,radius,currencycode,currencysymbol,converter)VALUES(:1,:2,:3,:4,:5,:6,:7,:8,:9)");
$stm->bindValue(':1',$ip);
$stm->bindValue(':2',$continent);
$stm->bindValue(':3',$country);
$stm->bindValue(':4',$lat);
$stm->bindValue(':5',$log);
$stm->bindValue(':6',$radius);
$stm->bindValue(':7',$currencycode);
$stm->bindValue(':8',$currencysyombol);
$stm->bindValue(':9',$converter);
$stm->execute();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <meta name="description" content="Create an Online Shop for Free, Connect fellow merchants, earn Online">
  <meta name="keywords" content="Online, Shop, ecommerce, earn Online, pysale">
  
<title>Psale</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}

* {
  box-sizing: border-box;
}
.top{
    background-size: 100%;
    max-width: 100%;
     border-top-left-radius: 50px 20px;
      border-top-right-radius: 50px 20px;
    }

/* Add padding to containers */
.container {
 border-radius: 5px;
 border: 1px transparent;
  padding: 16px;
  background-color: white;
  max-width: 500px;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border-radius: 5px;
  border: none;
  background-color: #f1f1f1;
   font-size: 17px;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
/* Set a style for the submit button */
.loginbtn{
  background-color: royalblue;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-size: 18px;
  border-radius: 10px;
  position: relative;
   z-index: 0;
}

.loginbtn:before {
  content: '';
  background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
  position: absolute;
  top: -2px;
  left:-2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing 20s linear infinite;
  opacity: 0;
  transition: opacity .3s ease-in-out;
  border-radius: 10px;
}


.loginbtn:active:after {
    background: transparent;
}

.loginbtn:hover:before {
    opacity: 1;
}

.loginbtn:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #rebeccapurple;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}

/* Add a blue text color to links */

a{
  text-decoration: none;
  color: royalblue;
  font-weight: bold;
  opacity: 0.8;
}

.link{
  position: relative;
}

.link::before{
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
  .link:hover::before{
    left: 0;
    right: auto;
    width: 100%;
  }
}
.signup {
  background-color: #f1f1f1;
  text-align: center;
}

</style>
</head>
<body>

<form action="login.php" method="post">
  <center>
  <div class="container">
    <div class="top"> 
<h1 style="opacity: 0.8;">pySale</h1>
   <marquee width="60%" direction="right"> <p>Login To Your Online Shop. Connect with fellow merchants</p></marquee>
    <hr>
    </div>
    

    <label for="username" style="opacity: 0.8;"><b>userName</b></label>
    <input type="text" placeholder="Enter userName" name="username" id="username" required>

    <label for="psw" style="opacity: 0.8;"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <hr>
    <button type="submit" class="loginbtn">Login</button>
  </div>
  
  <div class="container signup">
    <p>Do'nt have an account? <a href="signup.php" class="link">Sign Up</a>.</p>
    <p>Forgot password? <a href="recmail.php" class="link">Recover</a>.</p>
  </div>
  </center>
</form>

</body>
</html>