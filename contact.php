<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pysale | Contact</title>
  <style type="text/css">

   input[type=text ], input[type=email], textarea {
  width: 100%; 
  padding: 12px; 
  border: 1px solid #ccc; 
  border-radius: 4px;
  box-sizing: border-box; 
  margin-top: 6px; 
  margin-bottom: 16px;
  resize: vertical 
}

input[type=submit] {
  background-color: royalblue;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 17px;
  width: 100%;
}

input[type=submit]:hover {
  opacity: 0.7;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  max-width: 500px;

}
@media(max-width: 780px){

  .container{
  
  }
}
  </style>
</head>
<body>
  <center>
<div class="container">
  <form action="contact-loger.php" method="post">

    <label for="name">First Name</label>
    <input type="text" id="name" name="name" placeholder="Your name..">

    <label for="lname">Email</label>
    <input type="email" id="email" name="email" placeholder="Your Email..">
     <label for="lname">Subject</label>
    <input type="text" id="sub" name="sub" placeholder="Your Subject...">
    <label for="subject">Details</label>
    <textarea id="des" name="des" placeholder="Details here..." style="height:200px"></textarea>
    <input type="submit" value="Submit">

  </form>
</div>
</center>
</body>
</html>