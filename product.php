<?php 

class Product{
    public $id;
    public $name;
    public $price;
    public $image;
    public $description;
    public $category;
    public $quantity;
    public $status;
    public $date;
    public $user_id;
    /**
     * Class constructor.
     */
    public function __construct($user_id,$name,$description,$price,$image,$quantity)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->quantity = $quantity;
        $this->status = 1;
        $this->date = date('Y-m-d H:i:s');

    }
    public function isValid():bool
    {
        if($this->user_id===null){
            return false;
        }

        if($this->name===null) {
    return false;
    }
    if($this->description===null) {
    return false;
}
    if($this->price===null) {
    return false;
}
if($this->price!=null){
    if(!is_numeric($this->price)){
        return false;
    }
}
if($this->image===null) {
    return false;
}
if(intval($this->quantity)===0) {
    return false;
}
if($this->quantity!=null){
    if(!is_numeric($this->quantity)){
        return false;
    }
}
return true;
}

}
?>