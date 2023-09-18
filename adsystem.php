<?php
class AdSystem{
    /**
     * Class constructor.
     */
    public $error;
    public function __construct()
    {
        
    }
    public function isValidBlob($username,$rawaid,$front,$side,$top):bool
    {
       if(empty($username)){
        $this->error="user name";
        return false;
       }
       if(empty($rawaid)){
        $this->error="navigation";

        return false;
       }
       if(empty($front)){
        $this->error="front view image";
        return false;
       }
       if(empty($side)){
        $this->error="side view image";
        return false;
       }
       if(empty($top)){
        $this->error="top view image";
        return false;
       }
       return true;
    }
    public function isValidAD($username,$category,$name,$des,$price,$aid, $instock):bool
    {
       if(empty($username)){
        $this->error="user name not provided";

        return false;
       }
       if(empty($rawaid)){
        $this->error="navigation";

        return false;
       }
       if(empty($category)){
        $this->error="Category not provided";

        return false;
       }
       if(empty($name)){
        $this->error="name not provided";

        return false;
       }
       if(empty($des)){
        $this->error="description not provided";
        return false;
       }
       if(empty($price)){
        $this->error="price not provided";
        return false;
       }
       if(empty($aid)){
        $this->error="navigation";
        return false;
       }
       if(empty($instock)){
        $this->error="available stock not provided";
        return false;
       }
       return true;
    }
    public function getError()
    {
        return $this->error;
    }
} 
?>