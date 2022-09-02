<?php

class DateInput {
    public $name = null;
    public $value = null;
    protected $label = null;


    public function __construct($_name, $_value, $_label)
    {
        $this->name = $_name;
        $this->value =  $_value;
        $this->label = $_label;
    }


    public function __toString()
    {
        return '<div class="form-group row mb-3" id="'.$this->name.'">'.
        '<label class="col-sm-2 col-form-label">'.$this->label.'</label>'.
        '<div class="col-sm-10">'.
          '<input type="date" class="form-control" name="'.$this->name.'" placeholder="'.$this->label.'" value="'.$this->value.'" required>'.
        '</div>'.
        '</div>';
    }
}