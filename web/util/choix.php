<?php

class Choix{
    public $value = null;
    public $denom = null;

    public function __construct($_value, $_denom){
        $this->value = $_value;
        $this->denom = $_denom;
    }

}