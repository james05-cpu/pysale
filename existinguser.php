<?php 
include('conn.php');
class ExistingUser{
    public $id;
    public $conn;
    /**
     * Class constructor.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->conn=new SQLite3('data.sq3');
    }
    public function login($username,$password)
    {
        $query=$this->conn->query("SELECT COUNT(*) as count FROM `USERS` WHERE `username`='$username' AND `password`='$password'");
        $row=$query->fetchArray();
        $count=$row['count'];
 
        if($count > 0){
                $_SESSION['username']=$username;
                header("Location:dashboard.php");
        }
        else{
            echo "<div class='alert alert-danger'>Invalid username or password</div>";

   }
 }
 public function logout($username)
 {
   session_destroy();
 }
 public function getUserInfo($username)
 {
    $stm=$this->conn->prepare("SELECT* FROM USERINFO where `username`=?");
                $stm->bindValue(1,$username);
                $res=$stm->execute();
                while( $row=$res->fetchArray()){
                        $udata = array('username'=>$row["username"], 'fullname'=>$row["fullname"], 'loc'=>$row["loc"],'imgsrc'=>$row["imgsrc"]);
                }
                return $udata;
 }

}
?>