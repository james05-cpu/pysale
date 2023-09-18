<?php
class CartTransaction{
    public $buyer;
    public $seller;
    public $action;

    /**
     * Class constructor.
     */
    public function __construct($buyer,$seller,$action)
    {
        $this->buyer = $buyer;
        $this->seller=$seller;
        $this->action=$action;
    }
    public function isValid():bool
    {
        if(empty($this->buyer)||empty($this->seller)||empty($this->action)){
            return false;
        }
        return true;
    }
} 
?>