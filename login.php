<?php
session_start(); 
include('conn.php');
include('existinguser.php');

        $username = SQLite3::escapeString($_POST['username']);
        $password =hash('sha256', SQLite3::escapeString($_POST['password']));
if($username==null || $password==null){
header("Location:logError.php");
exit;
}
        $existingUser=new ExistingUser($username);
        $existingUser->login($username,$password);      

?>
