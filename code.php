<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>pySale | Code</title>
<style>
body {
  display: flex;
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
  width: 100%;
  height: 100%;
 justify-content: center;
 margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}

* {
  box-sizing: border-box;
}
.component{
  
}

.info{

  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
 margin-bottom: 30px;
  height: 60px;
  width: 100%;
}
#logo{
  height: 80px;
  width: 80px;
  margin-left: 10px;
}
.info img{
  width: 100%;
  height: 100%;
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
input[type=text], input[type=password], input[type=email], input[type=tel] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border-radius: 5px;
  border: none;
  background: #f1f1f1;
  font-size: 17px;
}

input[type=text]:focus, input[type=password], input[type=email] 
,input[type=tel]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.recover {
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

.recover:before {
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


.recover:active:after {
    background: transparent;
}

.recover:hover:before {
    opacity: 1;
}

.recover:after {
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
  color: #0074D9;
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

/* Set a grey background color and center the text of the "sign in" section */
.login {
  background-color: #f1f1f1;
  text-align: center;
}

</style>
</head>
<body>
<div class="component" >
<form action="checkcode.php" method="post">
  <div class="container">
   <div class="info">     
  </div>
  <center><marquee width="60%" direction="right"> <p>Enter the code sent to your email here</p></marquee></center>
    <input type="text" placeholder="Enter Code" name="code" id="code" required>
   
    <button type="submit" class="recover">Submit</button>
  </div>
  
  <div class="container login">
     <p>Don't have an account? <a href="signup.php" class="link">Sign Up</a>.</p>
  <p>By creating an account you agree to our <a href="policy.html" class="link">Terms & Privacy</a>.</p>
  </div>
</form>
</div>

</body>
</html>

