<?php
class Addresses {
    private $addressid;
    private $streetname;
    private $streetnumber;
    private $unitnumber;
    private $city;
    private $province;
    private $postalcode;

    public function __construct() {
        $this->addressid = 0;
        $this->streetname = '';
        $this->streetnumber = '';
        $this->unitnumber = '';
        $this->city = '';
        $this->province = '';
        $this->postalcode = '';

    }

    public function getAddressID() {
        return $this->addressid;
    }

    public function setAddressID($value) {
        $this->addressid = $value;
    }

    public function getStreetName() {
        return $this->streetname;
    }

    public function setStreetName($value) {
        $this->streetname = $value;
    }

    public function getStreetNumber() {
        return $this->streetnumber;
    }

    public function setStreetNumber($value) {
        $this->streetumber = $value;
    }

    public function getUnitNumber() {
        return $this->unitnumber;
    }

    public function setUnitNumber($value) {
        $this->unitnumber = $value;
    }
    
    public function getCity() {
        return $this->city;
    }

    public function setCity($value) {
        $this->city = $value;
    }
    
    public function getProvince() {
        return $this->province;
    }

    public function setProvince($value) {
        $this->province = $value;
    }
}
?>