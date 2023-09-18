<?php
class SettingInfo{
    public $username;
    public $followingtext;
    public $followertext;
    public $customertext;

    /**
     * Class constructor.
     */
    public function __construct($username, $followingtext, $followertext, $customertext)
    {
        $this->username=$username;
        $this->followingtext=$followingtext;
        $this->followertext=$followertext;
        $this->customertext=$customertext;
    }
   public function isValid():bool
   {
    if(empty($this->username)) {
        return false;
    }
    if(empty($this->followingtext)) {
        return false;
    }
    if(empty($this->followertext)) {
        return false;
    }
    if(empty($this->customertext)) {
        return false;
    }
    return true;
   }
}
?>