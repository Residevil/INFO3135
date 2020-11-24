<?php
class VehicleType{
    private $vehicletypeid;
    private $name;
    private $description;
    
    public function _construct(){
        $this->vehicletypeid = 0;
        $this->name = '';
        $this->description = '';
    }
    
    public function getVehicleTypeID(){
        return $this->vehicletypeid;
    }
    
    public function setVehicleTypeID($value){
        $this->vehicletypeid = $value;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($value){
        $this->name = $value;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($value){
        $this->description = $value;
    }
}
?>
