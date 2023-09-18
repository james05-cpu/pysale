<?php
class Activity{
    public $id;
    public $name;
    public $description;
    public $date;
    public $time;

    public function __construct($id, $name, $description, $date){
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->date = $date;
}
public function isValid():bool{
if(empty($this->name) || empty($this->description) || empty($this->date)) {
    return false;
}
return true;
}
} 
?>