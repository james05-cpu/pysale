<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pySale | Finnish</title>
    <link rel="stylesheet" href="style.css">
<style>
body{
margin: 0;
background: url("bgd1.jpg");
background-size: cover;
background-repeat: no-repeat;
}
    .stepTwo-container{
    align-items:center;
padding:20px;
}
.stepTwo-info{
margin-top:15px;
width: 300px;
display:flex;
flex-direction: column;
}
.stepTwo-info input[type=text], textarea{
width:100%;
margin:5px 0 22px 0;
display:inline-block;
background:white;
border:none;
border-bottom:2px solid;
font-size: 17px;
}
.stepTwo-info .file-field{
display:flex;
flex-direction:column;
}
.stepTwo-info .sub{
background-color:blue;
color:white;
width:100%;
border:none;
cursor:pointer;
display:inline-block;
height:30px;
margin-top:30px;
opacity:0.7;
}
.stepTwo-info .sub:hover{
opacity:0.8;
}
.output{
height: 250px;
width: 250px;
}
.txt{
    resize:vertical;
    font-size: 18px;
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
label,h1{
    opacity: 0.7;
}
</style>
</head>
<body>
<div class="stepTwo-container">
<div class="stepTwo-header">
        <h1>Profile Information</h1>
    </div>
<!--    <hr>--><form action="finnish.php" method="post" enctype="multipart/form-data">
    <div class="stepTwo-info">
    <label>Shop Name</label>
    <input type="text" name="storename" required>
    <label>Location</label>
    <input type="text" name="loc" required>
    <label>Your Name</label>
    <input type="text" name="fullname" required>
    <label>Description</label>
    <textarea class="txt" cols="20" rows="6" name="des" maxlength="180" minlength="70" required></textarea>
        <div class="file-field">
        <label>Profile pic</label>
<div>
<img id="output">
        <input type="file" name="image" onchange="loadFile(event)" required>
<div>
        <input type="submit" class="sub" value="Submit">
    </div>
</form>
</div>
<script>
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
