<?php

class Caterer {
    
    public $catererId;
    public $name;
    public $description;
    public $street;
    public $zip;
    public $city;
    public $phone;
    public $homepage;
    public $maxPerson;
    public $preOrderTime;
    public $deliveryRadius;
    public $servicePersonal;
    public $kitchen = array();
    
    public function kitchenToString() {
        $string = "";
        
        foreach($this->kitchen as $item) {
            $string .= $item . ", ";
        }
        return $string;
    }
    
}


?>
