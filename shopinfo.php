<?php
class ShopInfo{

    public $shopID;
    public $shopName;
    public $shopDescription;
    public $shopLocation;
    public $pic;
    public $shopOwner;
    public $ownerName;
   
    /**
     * Class constructor.
     */
    public function __construct($shopID,$shopName,$shopDescription,$shopLocation,$pic ,$shopOwner,$ownerName)
    {
        $this->shopID=$shopID;
        $this->shopName=$shopName;
        $this->shopDescription=$shopDescription;
        $this->shopLocation=$shopLocation;
        $this->pic=$pic;
        $this->shopOwner=$shopOwner;
        $this->ownerName=$ownerName;
    }
    public function isValid():bool
    {
    if(empty($this->shopID)) {
        return false;
    }
    if(empty($this->shopName)) {
        return false;
    }
    if(empty($this->shopDescription)) {
        return false;
    }
    if(empty($this->shopLocation)) {
        return false;
    }
    if(empty($this->pic)) {
        return false;

    }
    if(empty($this->shopOwner)) {
        return false;

    }
    if(empty($this->ownerName)) {
        return false;

    }
    return true;

}

} 
?>