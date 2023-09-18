<?php
session_start();
include('conn.php');
$uid=$_SESSION['username'];
if($uid==null){
//header("Location:index.php");
exit;
}

$uid=$_SESSION['username'];
$p1=$_POST['newP'];
$p2=$_POST['confirmP'];

if($p1==$p2){
$p=hash('sha256', SQLite3::escapeString($_POST['newP']));
$stm=$conn->prepare("UPDATE USERS set password=? where username=? ");

$stm->bindValue(1,$p);
$stm->bindValue(2,$uid);
$stm->execute();
header("Location:index.php");
}
else{
echo('<!DOCTYPE html>
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
        <p>Hello user, we could not complete your request</p>
        <p>Click the link bellow to try again</p>
        <p class="link"><a href="reset.php">Try Again</a></p>
    </div>
</body>
</html>');
//header("Location:resetError.php");
}
?>
