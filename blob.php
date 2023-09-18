<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pySale | Blob</title>
<link rel="stylesheet" href="style.css">
    <style>
    .container1{
    align-items:center;
    width:270px;
     margin-top:100px;
    }

.form1{
display:flex;
flex-direction:column;
}
.front, .top, .side{
    display: flex;
    flex-direction: column;
   }
  
     .btn1{
    padding: 10px 30px;
    color: #fff;
    background: #862d2d;
    border-radius: 5px;
    border: none;
    outline: none;
    margin-right: 10px;
    cursor: pointer;
    width:100%;
}
.output{
height: 250px;
width: 250px;
}
input[type="file"]{
    align-items: center;
  width: 100%;
  padding: 5px 20px 0   20px;
  margin: 5px 10px22px 0;
  display: block;
  border: none;
  text-align: center;
  background:green;
  border-radius: 10px;

}
.lb1, .lb2,.lb3{
font-weight: 500;
opacity: 0.6;
margin-bottom: 5px;
  
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
            <li><a href="/upload.php">Upload</a></li>
            <li><a href="/profile.php">Profile</a></li>
                        <li><a href="/logout.php">Logout</a></li>
        </div>
    </ul>
</nav>

<center>
<div class="container1">
<form action="insert-blob.php" method="post" enctype="multipart/form-data">
    <div class="form1">
<div class="front">
    <div class="lb1">Product Front View Image</div>
    <img id="output">
       <div class="f1"> <input type="file" class="image" name="front"  onchange="loadFile1(event)" required>
       </div>
    </div>
    <div class="side">
        <div class="lb2">Product Side View Image</div>
        <div class="f2">
                <img id="output1">
       <input type="file" class="image" name="side"  onchange="loadFile2(event)" required>
   </div>
   </div>
   <div class="top">
    <div class="lb3">Product Top View Image</div>
    <div class="f3">
            <img id="output2">

            <input type="file" class="image" name="top"  onchange="loadFile3(event)" required>
        </div>
        </div>
        <div class="buttons">
            <input type="submit" class="btn1" id="add-btn" value="Next">
        </div>
</div>
</form>
</div>

</center>

<script>
  var loadFile1 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
output.classList.add('output')   
 };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile2 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output1');
      output.src = reader.result;
output.classList.add('output')   
 };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile3 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output2');
      output.src = reader.result;
output.classList.add('output')   
 };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
</body>
</html>
