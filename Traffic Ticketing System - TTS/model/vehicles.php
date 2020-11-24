<?php
class Vehicles{
    private $licenseplatenumber;
    private $name;
    private $colour;
    private $vehicletypeid;
    private $manufacturercode;
    
    public function _construct(){
        $this->licenseplatenumber = '';
        $this->colour = '';
        $this->name = '';
    }
    
    public function getLicensePlateNumber(){
        return $this->licenseplatenumber;
    }
    
    public function setLicensePlateNumber($value){
        $this->licenseplatenumber = $value;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($value){
        $this->name = $value;
    }
    
    public function getColour(){
        return $this->colour;
    }
    
    public function setColour($value){
        $this->colour = $value;
    }
}
?>

