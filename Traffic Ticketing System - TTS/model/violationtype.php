<?php
class ViolationType {
    private $violationtypeid;
    private $name;
    private $description;
    
    public function __construct() {
        $this->violationtypeid = 0;
        $this->name = '';
        $this->description = '';
    }

    public function getViolationTypeID() {
        return $this->violationtypeid;
    }

    public function setViolationTypeID($value) {
        $this->violationtypeid = $value;
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