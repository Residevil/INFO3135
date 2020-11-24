<?php
class Violations{
    private $violationid;
    private $violationnumber;
    private $violationdate;
    private $fineamount;
    private $fineduedate;
    private $violatorid;
    private $violationtypeid;
    private $licenseplatenumber;
    
    public function _construct(){
        $this->violationid = 0;
        $this->violationnumber = '';
        $this->violationdate = '';
        $this->fineamount = '';
        $this->fineduedate = '';
    }
    
    public function getViolationID(){
        return $this->violationid;
    }
    
    public function setViolationID($value){
        $this->violationid = $value;
    }
    
    public function getViolationNumber(){
        return $this->violationnumber;
    }
    
    public function setViolationNumber($value){
        $this->violationnumber = $value;
    }
    
    public function getViolationDate(){
        return $this->violationdate;
    }
    
    public function setViolationDate($value){
        $this->violationdate = $value;
    }
    
    public function getFineAmount(){
        return $this->fineamount;
    }
    
    public function setFineAmount($value){
        $this->fineamount = $value;
    }
    
    public function getFineDueDate(){
        return $this->fineduedate;
    }
    
    public function setFineDueDate($value){
        $this->fineduedate = $value;
    }
}
?>

