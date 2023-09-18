<?php
session_start(); 
include('conn.php');
$to=$_POST['email'];
$_SESSION['mail']=$to;
$stm=$conn->prepare("SELECT * FROM USERS where email=?");
$stm->bindValue(1,$to);
$res=$stm->execute();
$code="0";
while( $row=$res->fetchArray()){
$code=$row['code'];

}
         $subject = "pySale Accounts";
         $message = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       
        body{
            width: 100%;
            justify-content: center;
            align-items: center;
            align-content: center;
        }
        h1{
            padding: 16px;
        }
        h2{
            padding: 8px;
        }
        h4{
            font-size: 17px; 
        }
        p{
          font-size: 17px;
          font-weight: 400;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>pySale Accounts</h1>
        <hr>
        <p>Hello user, Your password reset request has been recieved</p>
        <p>If the request is not from you, just ignore</p>
        <p>Kindly user the code bellow to complete the reset process</p>
        <h2>'.$code.'</h2>
        <hr>
       <h4>Always in for you!!</h4>
    </div>
    
</body>
</html>

';
         
         $header = "From:service@pysale.co.ke \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
header("Location:code.php");
         }else {
            echo "Message could not be sent...";
         }
      ?>
