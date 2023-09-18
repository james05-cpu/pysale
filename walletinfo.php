<?php 
class WalletInfo{
    public $wallet_id;
    public $wallet_bal;
    /**
     * Class constructor.
     */
    public function __construct($wallet_id,$wallet_bal)
    {
        $this->wallet_id = $wallet_id;
        $this->wallet_bal = $wallet_bal;
    }
    public function isValid()
    {
        if(empty($this->wallet_id)) {
            return false;
    
        }
        if(empty($this->wallet_bal)) {
            return false;
    
        }
        return true;
    }
}
?>