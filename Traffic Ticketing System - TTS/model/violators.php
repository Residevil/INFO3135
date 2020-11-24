<?php
class Violators{
    private $violatorid;
    private $driverslicensenumber;
    private $name;
    private $addressid;
    
    public function _construct(){
        $this->violatorid = 0;
        $this->driverslicensenumber = '';
        $this->name = '';
    }
    
    public function getViolatorID(){
        return $this->violatorid;
    }
    
    public function setViolatorID($value){
        $this->violatorid = $value;
    }
    
    public function getDriversLicenseNumber(){
        return $this->driverslicensenumber;
    }
    
    public function setDriversLicenseNumber($value){
        $this->driverslicensenumber = $value;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($value){
        $this->name = $value;
    }
}
?>