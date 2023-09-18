<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>pySale | Upload</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}

* {
  box-sizing: border-box;
}
body{
  margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
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
input[type=text], input[type=password], input[type=email],input[type=number], textarea{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border-radius: 5px;
  border: none;
  background: #f1f1f1;
  font-size: 17px;
}
input[type ="file"]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: block;
  border: none;
  background: green;
  border-radius: 10px;
}
input[type=text]:focus, input[type=password],textarea, input[type=number], input[type=email]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
b{
  opacity: 0.7;
}
h1{
opacity: 0.7;
}
p{
  opacity: 0.8;
}
/* Set a style for the submit button */
.add {
  background-color: royalblue;
  color: white;
  padding: 10px 20px;
  margin: 14px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-size: 18px;
  border-radius: 5px;
}

.add:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.login {
  background-color: #f1f1f1;
  text-align: center;
}
a:hover{
  color: red;
}
textarea{
  resize: vertical;
  font-size: 18px;
}
.output{
height: 250px;
width: 100%;
}
#top{
  font-size: 18px;
}
.header{
  margin-left: 20px;
  margin-right: 20px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-content: center;
  align-items: center;
}
.header .back-icon{
  color: #333;
  font-size: 18px;
  opacity: 0.5;
}

</style>
</head>
<body>

<form action="add.php" method="post" enctype="multipart/form-data" >
  <center>
  <div class="container">
    <div class="header"> 
      <a href="#" class="back-icon" onclick="goBack()" ><i class="fas fa-arrow-left"></i></a>
       <h1>pySale</h1>
</div>
    <p id="top">New product will reflect in your store immediately after submiting the details</p>
    <hr>

    <label for="productname"><b>Product Name</b></label>
    <input type="text" placeholder="Product name" name="productname" id="Product" required>
 <label for="price"><b>Price</b></label>
    <input type="number" placeholder="Enter price" name="price" id="price" min="1" required>
    <label for="quad"><b>Quantity</b></label>
    <input type="number" placeholder="Available stock" name="instock" id="instock" min="1" required>

    <label for="des"><b>Description</b></label>
    <textarea name="des" placeholder="Product description...." style="height: 150px;" maxlength="150" minlength="75" required></textarea>
      Product Image <input type="file" name="image" onchange="loadFile(event)"  required>
    <hr>
    <img id="output">
    <button type="submit" class="add">Submit</button>
  </div>
  
  <div class="container login">
    <p></p>
  
  </div>
  </center>
</form>
<script>
function goBack() {
  window.history.back()
}

  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
output.classList.add('output')   
 };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
</body>
</html>