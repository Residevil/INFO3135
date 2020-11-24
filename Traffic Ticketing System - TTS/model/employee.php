<?php
class Employee {
    private $employeeid;
    private $name;
    private $employeetypeid;
    private $addressid;
    private $email;
    private $password;
    
    public function _construct(){
        $this->employeeid = 0;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    
    public function getEmployeeID(){
        return $this->employeeid;
    }
    
    public function setEmployeeID($value){
        $this->employeetypeid = $value;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($value){
        $this->name = $value;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($value){
        $this->email = $value;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($value){
        $this->password = $value;
    }
}
?>
