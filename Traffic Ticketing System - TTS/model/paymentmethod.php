<?php
class PaymentMethod{
    private $paymentmethodcode;
    private $name;
    private $description;
    
    public function _construct(){
        $this->paymentmethodcode = 0;
        $this->name = '';
        $this->description = '';
    }
    
    public function getPaymentMethodCode(){
        return $this->paymentmethodcode;
    }
    
    public function setPaymentMethodCode($value){
        $this->paymentmethodcode = $value;
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

