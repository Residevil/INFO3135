<?php
class EmployeeType {
    private $employeetypeid;
    private $name;
    private $description;
    
    public function __construct() {
        $this->employeetypeid = 0;
        $this->name = '';
        $this->description = '';
    }

    public function getEmployeeTypeID() {
        return $this->employeetypeid;
    }

    public function setEmployeeTypeID($value) {
        $this->employeetypeid = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }
 
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($value) {
        $this->description = $value;
    }
}
?>