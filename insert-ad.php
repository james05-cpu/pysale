<?php
session_start();
include('conn.php');
include('auth.php');
include('adsystem.php');
$uid=$_SESSION['username'];
if($uid===null){
header("Location:index.php");
exit;

}

$adcheck = $conn->query("SELECT COUNT(*) as count FROM ADS where username='$uid'");
$adno = $adcheck->fetchArray();
$no = $adno['count'];

if($no>0){
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
        <p>Note that: You can only have one AD in a day</p>
        <p class="link">Return to? &nbsp <a href="dashboard">Dashboard</a></p>
    </div>
</body>
</html>');
exit;
}
function Error($message){
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
           <p>There is a problem with  '.$message.'</p>
           <p class="link"><a href="ads.php">Try Again</a></p>
           </div>
   </body>
   </html>');
}

   $category=SQLite3::escapeString(strip_tags($_POST['category']));
   $name=SQLite3::escapeString(strip_tags($_POST['productname']));
    $username=$_SESSION['username'];
     $price=SQLite3::escapeString(strip_tags($_POST['price']));
     $instock=SQLite3::escapeString(strip_tags($_POST['instock']));
     $des=SQLite3::escapeString(strip_tags($_POST['des']));
     $id=rand(999,999999999);
$htm=time();
$aid=Auth::generateID(8);
$_SESSION['rawid']=$aid;
$system=new AdSystem();
if($system->isValidAD($username,$category,$name,$des,$price,$aid,$instock)){
   $stm=$conn->prepare("INSERT INTO `ADS` (username,category,name,des,price,aid, instock) VALUES(:1,:2,:3,:4,:5,:6,:7)");
   $stm->bindValue(':1',$username);
   $stm->bindValue(':2',$category);
   $stm->bindValue(':3',$name);
   $stm->bindValue(':4',$des);
   $stm->bindValue(':5',$price);
   $stm->bindValue(':6',$aid);
   $stm->bindValue(':7',$instock);
   $stm->execute();
   header("Location:blob.php");
   exit;
}
else{
   $message=$system->getError();
   Error($message);
   exit;
}

?>
