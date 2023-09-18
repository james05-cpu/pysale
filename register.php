<?php
include('conn.php');
include('auth.php');
include('newuser.php');
session_start();
     $username=SQLite3::escapeString($_POST['username']);
     $email=SQLite3::escapeString($_POST['email']);
     $phone=SQLite3::escapeString($_POST['phone']);
     $pass=hash('sha256', SQLite3::escapeString($_POST['password']));
$users = $conn->query("SELECT COUNT(*) as count FROM USERINFO where username= '$username'");
$itusers = $users->fetchArray();
$num = $itusers['count'];
if($num>0){
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
        <p>Hello user, we could not complete your request</p>
        <p>The user name you have entered already exist</p>
        <p class="link"><a href="signup.php">Try Again</a></p>
    </div>
</body>
</html>');
exit;
}
$user=new User($username,$email,$phone,$pass);
if($user->isValid()){
     $_SESSION["username"]=$username;
     $code=Auth::generateID(6);
     mkdir("upload/".$username);
   //  $conn->exec("INSERT INTO `USERS` (username, email,password)
    $stm=$conn->prepare("INSERT INTO `USERS` (username, email,password,code,phone)VALUES(:1,:2,:3,:4,:5)");
    $stm->bindValue(':1',$username);
    $stm->bindValue(':2',$email);
    $stm->bindValue(':3',$pass);
    $stm->bindValue(':4',$code);
    $stm->bindValue(':5',$phone);
    
    $stm->execute();
    header("Location:stepto.php");
    
}

?>
