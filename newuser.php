<?php
class User{
    public $username;
    public  $email;
    public  $phone;
    public $pass;
    /**
     * Class constructor.
     */
    public function __construct($username,$email,$phone,$pass)
    {
        $this->username= $username;
        $this->email=$email;
        $this->phone=$phone;
        $this->pass=$pass;
    }
    public function isValid():bool
    {
if(empty($this->username)) {
    return false;
}
if( empty($this->pass)){
    return false;
}
if( empty($this->email)){
    return false;
}
if( empty($this->phone)){
    return false;
}
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
          }
          return true;
    }
} 
?>