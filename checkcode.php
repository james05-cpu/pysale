<?php
session_start(); 
include('conn.php');
$code=$_POST['code'];
$email=$_SESSION['mail'];

 $id=rand(999,999999999);
$tm=time();
$code1=$id+$tm;

 $query=$conn->query("SELECT COUNT(*) as count FROM `USERS` WHERE `email`='$email' and code='$code'");
        $row=$query->fetchArray();
        $count=$row['count'];
 
        if($count > 0){
           $stm=$conn->prepare("UPDATE  USERS set code=? where email=?");
$stm->bindValue(1,$code1);
$stm->bindValue(2,$email);
$stm->execute();
 $stm=$conn->prepare("SELECT * FROM USERS WHERE email=?");
$stm->bindValue(1,$email);
$res=$stm->execute();
while( $row=$res->fetchArray()){
$_SESSION['username']=$row['username'];

}

header("Location:reset.php");
        }

        else{
            echo ('<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code | Error</title>
    <style>
        h1{
            padding: 16px;
        }
        body{
            width: 100%;
            justify-content: center;
            align-items: center;
            align-content: center;
        }
        h1{
            padding: 16px;
        }
    
        p{
          font-size: 17px;
          font-weight: 400;
          padding-left: 16px;
        }
        p a{
            text-decoration: none;
            color: white;
            background-color: royalblue;
            padding: 8px 60px;
            border-radius: 30px;
            font-size: 18px;
        }
        .link{
            margin-top: 30px;
        }
        p a:hover{
            opacity: 0.7;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="containter">
        <h1>pySale Acounts</h1>
        <p>Hello user, the reset code you have entered is wrong</p>
        <p>Click the link bellow to try again</p>
        <p class="link"><a href="code.php">Try Again</a></p>
    </div>
</body>
</html>');

   }
     ?>
