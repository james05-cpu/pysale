<?php
class ContactInfo{
    public $email;
    public $name;
    public $sub;
    public $message;

    /**
     * Class constructor.
     */
    public function __construct($email,$name,$sub,$message)
    {
        $this->email = $email;
        $this->name=$name;
        $this->sub=$sub;
        $this->message=$message;
    }
    public function isValid():bool
    {
        if(empty($this->email)){
            return false;
        }
        if(empty($this->name)){
            return false;
        }
        if(empty($this->sub)){
            return false;
        }
        if(empty($this->message)){
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
          }
          return true;
    }
}
?>