<?php

class Identifiant {
    public $name = 'id';
    public $value = '';

    public function __construct($_value = ''){
        $this->value = $_value;
    }
    
    public function __toString()
    {
        return "<input  name='$this->name' type='hidden' value='$this->value'>";
    }
}