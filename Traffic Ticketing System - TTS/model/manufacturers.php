<?php
class Manufactueres{
    private $manufacturercode;
    private $manufacturername;
    
    public function _construct(){
        $this->manufacturercode = 0;
        $this->manufacturername = '';
    }
    
    public function getManufacturerCode(){
        return $this->manufacturercode;
    }
    
    public function setManufacturerCode($value){
        $this->manufacturercode = $value;
    }
    
    public function getManufacturerName(){
        return $this->manufacturername;
    }
    
    public function setManufacturerName($value){
        $this->manufacturername = $value;
    }
}
?>
