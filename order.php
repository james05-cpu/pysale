<?php
class Order{
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $seller;
    public $buyer;
    public $orderinfo;
    public $time;
    public $bid;
    public $status;
    public $sid;

    /**
     * Class constructor.
     */
    public function __construct($id,$seller,$buyer,$orderinfo,$time,$bid,$status,$sid)
    {
        $this->id = $id;
        $this->seller = $seller;
        $this->buyer = $buyer;
        $this->orderinfo = $orderinfo;
        $this->time = $time;
        $this->bid = $bid;
        $this->status = $status;
        $this->sid = $sid; 
      
    }
    public function isValid()
    {
        if($this->id===null){
            return false;
        }
        if($this->seller===null){
            return false;
            }
            if($this->buyer===null){
                return false;
                }
if($this->orderinfo===null) {
    return false;
}
if($this->time===null) {
    return false;
}
if($this->bid===null) {
    return false;
}
if($this->status===null) {
    return false;
}
if($this->sid===null) {
    return false;
}
return true;
            
    }

} 
?>